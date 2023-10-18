<?php
include_once(__DIR__ . '/../../config.php');
require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Conecta;

if (!isset($_POST)) {
	header("Location: " . _URL_);
}

//Definir variaveis de entrada:

$data 					= $_POST;
$nomeAplicativo = $data['nome'];
$REDIRECT 			= _URL_ . "/registrar_credenciais.php?app=" . $nomeAplicativo;

//Validar app:
$conecta = new Conecta($nomeAplicativo);
$aplicativo = $conecta->verificar_se_existe_aplicativo();

if (count($aplicativo) >= 1) {
	$_result = $conecta->update_credenciais($data);
} else {
	$_result = $conecta->salvar_credenciais($data);
}

//Após concluir , redireicionar o usuário para lista de apps:
if ($_result >= 1 || $_result) {
	header("Location:" . $REDIRECT);
	exit();
} else {
	die('Erro ao salvar credêncial!');
}
