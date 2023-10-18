<?php
include_once(__DIR__ . '/../../config.php');

require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Conecta;

if (!isset($_POST)) {
	header("Location: " . _URL_);
}
$data = $_POST;
$nomeAplicativo = $data['nome'];
$REDIRECT = _URL_ . "/registrar_credenciais.php?app=" . $nomeAplicativo;

$conecta = new Conecta($nomeAplicativo);

if (empty($conecta->verificar_se_existe_aplicativo())) {
	$_result = $conecta->insert_aplicativo($data);
} else {
	$_result = $conecta->update_aplicativo($data);
}

if ($_result >= 1 || $_result) {
	header("Location:" . $REDIRECT);
	exit();
} else {
	die('Erro ao salvar credêncial!');
}
