<?php

include_once __DIR__ . '/../../config.php';
require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Login;

$dados = $_POST;
if (empty($dados)) {
	header("Location: " . _URL_);
	exit();
}

$acesso = new Login();

$a = $acesso->getBydadosAcesso([
	"email" => $dados['email'],
	"password" => $dados['password'],
]);

if (count($a) >= 1) {
	$_SESSION['usuario'] = $a['usuario'];
	$_SESSION['acesso'] = true;

	unset($_SESSION['nao_autenticado']);
	header("Location: " . _URL_ . '/novo_aplicativo.php');
	exit();
} else {

	$_SESSION['nao_autenticado'] = true;
	header("Location: " . _URL_);
	exit();
}
