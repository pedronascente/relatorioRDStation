<?php

namespace App\Model;

use App\Model\Conecta;

class ProcessContatosJob
{
  private $_auth;
  private $_headers;
  private $_conecta;

  public function __construct()
  {
    $this->_conecta = new Conecta('app.relatorio');
    $this->_auth = $this->_conecta->get_dados_de_autenticacao();
    // Defina os cabeçalhos em um array
    $this->_headers = [
      'Content-Type: application/json',
      'Authorization: Bearer ' . $this->_auth['access_token'],
    ];
  }

  public function getContatosDaSegmentacao($campanha)
  {
    // Inicialize uma sessão cURL
    $curl = curl_init('https://api.rd.services/platform/segmentations/' . $campanha['id'] . '/contacts?order=created_at:desc&page=1&page_size=100');
    // Configurar as opções do cURL
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPGET => true,
      CURLOPT_HTTPHEADER => $this->_headers,
      CURLOPT_SSL_VERIFYPEER => false, // Desativa a verificação SSL do certificado
      CURLOPT_SSL_VERIFYHOST => false, // Opcional: Desativa a verificação do host SSL
      CURLOPT_TIMEOUT => 60 // Aumente o tempo limite para 60 segundos (ou o valor adequado)
    ]);
    // Realize a solicitação cURL
    $response = curl_exec($curl);
    // Verifique a resposta e processe os dados
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($response === false) {
      die("Erro cURL: " . curl_error($curl));
      return 0; // Tratar erro
    }
    // Feche a sessão cURL
    curl_close($curl);
    if ($httpCode === 200) {
      return   $this->getContatos($response, $campanha);
    } else if ($httpCode !== 200) {
      $this->_conecta->refresh_token();
    }
  }

  public function getListaSegmentacao()
  {
    $url = 'https://api.rd.services/platform/segmentations?page_size=50';
    // Inicialize uma sessão cURL
    $curl = curl_init($url);
    // Defina os cabeçalhos em um array
    $headers = [
      'Content-Type: application/json',
      'Authorization: Bearer ' . $this->_auth['access_token'],
    ];
    // Configurar as opções do cURL
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPGET => true,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_SSL_VERIFYPEER => false, // Desativa a verificação SSL do certificado
      CURLOPT_SSL_VERIFYHOST => false, // Opcional: Desativa a verificação do host SSL
    ]);
    // Realize a solicitação cURL
    $response = curl_exec($curl);
    // Verifique a resposta e processe os dados
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($response === false) {
      die("Erro cURL: " . curl_error($curl));
      return null; // Tratar erro
    }
    // Feche a sessão cURL
    curl_close($curl);
    if ($httpCode === 200) {
      $data = json_decode($response, true);
      return $data;
    } else {
      die("Erro ao buscar lista de segmentações: $httpCode");
      return null; // Tratar erro
    }
  }

  private function getContatos($response, $campanha)
  {
    $data = json_decode($response, true);
    $contatos = null;
    foreach ($data['contacts'] as $value) {
      $dataCriacao = explode('T', $value['created_at']);
      $contatos[] = [
        'empresa' => $campanha['empresa'],
        'servico' => $campanha['servico'],
        'campanha' => $campanha['campanha'],
        'name' => $value['name'],
        'email' => $value['email'],
        'cor' => $campanha['cor'],
        'created_at' => $dataCriacao[0],
      ];
    }
    return $contatos;
  }
}

/*

  private   function refreshToken()
  {

    $tokenEndpoint = 'https://api.rd.services/auth/token';

    $data = [
      'client_id' =>  $this->_auth['client_id'],
      'client_secret' => $this->_auth['client_secret'],
      'refresh_token' => $this->_auth['refresh_token'],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $tokenEndpoint,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => http_build_query($data),
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded',
        'accept: application/json',
      ],

      CURLOPT_SSL_VERIFYPEER => false, // Desativa a verificação SSL do certificado
      CURLOPT_SSL_VERIFYHOST => false, // Opcional: Desativa a verificação do host SSL
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
      // Em vez de imprimir o erro diretamente, você pode lançar uma exceção ou retornar uma mensagem de erro adequada.
      die('Erro cURL: ' . curl_error($curl));
    }

    curl_close($curl);

    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
      return $responseData['access_token'];
    } else {
      // Também é uma boa prática lançar uma exceção em vez de retornar null em caso de erro.
      die('Erro ao obter o novo access token');
    }
  }
*/