<?php

include_once __DIR__ . '/../../config.php';
require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Conecta;

$id = $_GET['id'];

if (!isset($id)) {
	header("Location: " . _URL_);
	exit();
} else {
	$id  = intval($id);
	if ($id == 0) {
		header("Location: " . _URL_);
		exit();
	}
}

$conecta = new Conecta();
$result = $conecta->delete($id);

if ($result >= 1) {
	header("Location: " . _URL_ . '/novo_aplicativo.php');
	exit();
} else {
	die($result);
}
