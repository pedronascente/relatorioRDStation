<?php

require __DIR__ . '../vendor/autoload.php';

use App\Model\Conecta;

function handleAuthentication($app)
{
	$code = isset($_GET['code']) ? $_GET['code'] : '';

	$conecta = new Conecta($app);
	$auth = $conecta->auth($code);

	var_dump($auth);

	if (isset($auth["errors"]) || !isset($auth["access_token"])) {
		echo "Erro de Autenticação. Tente novamente";
	} else {
		$config = $conecta->get_dados_de_autenticacao();
		header("Location: " . $config["app"]);
	}
}

if (isset($_GET['app'])) {
	$app = $_GET['app'];
	handleAuthentication($app);
} else {
	echo 'Você não possui app :(';
}
