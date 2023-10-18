<?php

namespace App\Model;

use App\Model\ConexaoDB;
use \PDO;

class Conecta
{
	private $_pdo;
	private $_app;
	private $_table = 'config';
	private $_url; // Adicione esta linha para declarar a propriedade $_url

	public function __construct($app = '')
	{
		$conn = new ConexaoDB();
		$this->_pdo = $conn->getDB();
		$this->_app = $app;
	}

	public function get_contact($email)
	{
		$config = $this->get_dados_de_autenticacao();
		$this->_url = $config["host"] . "/platform/contacts/email:" . $email;
		$request = "GET";
		$header = ['Authorization: Bearer ' . $config["access_token"]];
		$exec = $this->exec($this->_url, $request, $header);
		return $exec;
	}

	public function get_campos_personalizados()
	{
		$config = $this->get_dados_de_autenticacao();
		$this->_url = "https://api.rd.services/platform/contacts/fields";
		$request = "GET";
		$header = ['Authorization: Bearer ' . $config["access_token"]];
		$exec = $this->exec($this->_url, $request, $header);
		return $exec;
	}

	public function update_contact($email, $array_dados)
	{
		$config = $this->get_dados_de_autenticacao();
		$data = json_encode($array_dados);
		$this->_url = $config["host"] . "/platform/contacts/email:" . $email;
		$request = "PATCH";
		$header = ['Authorization: Bearer ' . $config['access_token'], 'Content-Type: application/json'];
		$exec = $this->exec($this->_url, $request, $header, $data);
		return $exec;
	}

	public function set_sale($email, $price)
	{
		$config = $this->get_dados_de_autenticacao();
		$price = (float)$price;
		$data['event_type'] = "SALE";
		$data['event_family'] = "CDP";
		$data['payload'] = [
			'email' => $email,
			'funnel_name' => 'default',
			'value' => $price,
		];
		$data = json_encode($data);
		$url = $config['host'] . "/platform/events";
		$request = "POST";
		$header = ['Authorization: Bearer ' . $config['access_token'], 'Content-Type: application/json'];
		$exec = $this->exec($url, $request, $header, $data);
		return $exec;
	}

	public function createEvent($campos_personalizados)
	{
		$array_dados = [
			"event_type" => "CONVERSION",
			"event_family" => "CDP",
			"payload" => $campos_personalizados
		];
		$config = $this->get_dados_de_autenticacao();
		$data = json_encode($array_dados);
		$url = $config['host'] . "/platform/events";
		$request = "POST";
		$header = ['Authorization: Bearer ' . $config['access_token'], 'Content-Type: application/json'];
		$exec = $this->exec($url, $request, $header, $data);
		$r = [$array_dados, $exec];
		return $r;
	}

	/*
     * [BASE MYSQL]
    */

	public function delete($id)
	{
		$app = count($this->getById($id));
		if ($app >= 1) {
			$stmt = $this->_pdo->prepare("DELETE FROM $this->_table WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->rowCount();
		} else {
			return 'Não foi possível excluir aplicativo! :(';
		}
	}

	public function listar_os_aplicativos_registrados()
	{
		$stmt = $this->_pdo->prepare("SELECT id, nome FROM $this->_table");
		$stmt->execute();
		$rs = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rs;
	}

	public function getById($id)
	{
		$stmt = $this->_pdo->prepare("SELECT id FROM $this->_table where id= :id");
		$stmt->execute(['id' => $id]);
		$rs = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rs;
	}

	public function salvar_credenciais($data)
	{
		$stmt = $this->_pdo->prepare(
			"INSERT INTO $this->_table (
					nome, 
					client_id, 
					client_secret, 
					callback, 
					app
			) VALUES (
					nome, 
					client_id, 
					client_secret, 
					callback, 
					app
			)"
		);
		$stmt->bindParam('nome', $data['nome']);
		$stmt->bindParam('client_id', $data['client_id']);
		$stmt->bindParam('client_secret', $data['client_secret']);
		$stmt->bindParam('callback', $data['callback']);
		$stmt->bindParam('app', $data['app']);
		$result = $stmt->execute();
		if (!$result) {
			var_dump($stmt->errorInfo());
			exit();
		}
		return $stmt->rowCount();
	}

	public function insert_aplicativo($data)
	{
		$nome = $data['nome'];
		$stmt = $this->_pdo->prepare("INSERT INTO $this->_table (nome) VALUES (?) ");
		$stmt->bindParam(1, $nome);
		$result = $stmt->execute();
		if (!$result) {
			var_dump($stmt->errorInfo());
			exit();
		}
		return $stmt->rowCount();
	}

	public function update_aplicativo($data)
	{
		$nome = trim($data['nome']);
		$stmt = $this->_pdo->prepare("UPDATE $this->_table SET  nome = :nome  WHERE nome = :nome");
		$stmt->bindValue(":nome", $nome);
		$run = $stmt->execute();
		return $run;
	}

	public function update_credenciais($data)
	{
		$nome = !empty($data['nome']) ? trim($data['nome']) : '';
		$app = !empty($data['app']) ? trim($data['app']) : '';
		$client_id = !empty($data['client_id']) ? trim($data['client_id']) : '';
		$client_secret = !empty($data['client_secret']) ? trim($data["client_secret"]) : '';
		$callback = !empty($data['callback']) ? trim($data["callback"]) : '';
		$stmt = $this->_pdo->prepare(
			"UPDATE $this->_table SET	
					nome = :nome,	
					app = :app, 
					client_id = :client_id, 
					client_secret = :client_secret, 
					callback = :callback 
			WHERE nome = :app_name"
		);
		$stmt->bindValue(":nome", $nome);
		$stmt->bindValue(":app", $app);
		$stmt->bindValue(":client_id", $client_id);
		$stmt->bindValue(":client_secret", $client_secret);
		$stmt->bindValue(":callback", $callback);
		$stmt->bindValue(":app_name", $this->_app);
		$run = $stmt->execute();
		return $run;
	}

	public function auth($code)
	{
		$config = $this->get_dados_de_autenticacao();
		$data = [
			'client_id' => $config['client_id'],
			'client_secret' => $config['client_secret'],
			'code' => $code,
		];
		$data = json_encode($data);
		$url = $config["host"] . "/auth/token";
		$request = "POST";
		$header = ['Content-Type: application/json'];
		$exec = $this->exec($url, $request, $header, $data);
		if ($exec !== null && !isset($exec["errors"])) {
			$stmt = $this->_pdo->prepare(
				"UPDATE $this->_table SET 
						access_token = :access_token, 
						refresh_token = :refresh_token, 
						code = :code 
					WHERE nome = :app"
			);

			$stmt->bindValue(":access_token", $exec['access_token']);
			$stmt->bindValue(":refresh_token", $exec['refresh_token']);
			$stmt->bindValue(":code", $code);
			$stmt->bindValue(":app", $this->_app);
			$stmt->execute();
		}

		return $exec;
	}

	public function refresh_token()
	{
		$config = $this->get_dados_de_autenticacao();

		$data = [
			'client_id' => $config['client_id'],
			'client_secret' => $config['client_secret'],
			'refresh_token' => $config['refresh_token'],
		];
		$data = json_encode($data);
		$url = $config["host"] . "/auth/token";
		$request = "POST";
		$header = ['Content-Type: application/json'];
		$exec = $this->exec($url, $request, $header, $data);

		if (isset($exec["access_token"])) {
			$stmt = $this->_pdo->prepare(
				"UPDATE $this->_table SET 
							access_token = :access_token,	
							refresh_token = :refresh_token 
					WHERE 
							nome = :app"
			);
			$stmt->bindValue(":access_token", $exec['access_token']);
			$stmt->bindValue(":refresh_token", $exec['refresh_token']);
			$stmt->bindValue(":app", $this->_app);
			$stmt->execute();
		}

		return $exec;
	}

	public function verificar_se_existe_aplicativo()
	{
		$stmt = $this->_pdo->prepare("SELECT nome FROM $this->_table  WHERE nome = :nome");
		$stmt->execute(['nome' => $this->_app]);
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function get_dados_de_autenticacao()
	{
		$stmt = $this->_pdo->prepare("SELECT * FROM $this->_table  WHERE  nome = :nome");
		$stmt->execute(['nome' => $this->_app]);
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function exec($url, $request, $header, $data = "")
	{
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $request,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_SSL_VERIFYPEER => false, // Desativa a verificação SSL do certificado
			CURLOPT_SSL_VERIFYHOST => false, // Opcional: Desativa a verificação do host SSL
		]);

		$response = curl_exec($curl);

		if ($response === false) {
			echo 'Erro cURL: ' . curl_error($curl);
		}

		curl_close($curl);
		return json_decode($response, true);
	}
}
