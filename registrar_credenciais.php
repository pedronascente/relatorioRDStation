<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/includes/head.php");

require __DIR__ . '/vendor/autoload.php';

use App\Model\Conecta;

$app = $_GET['app'];

if (!isset($app)) {
  header("Location: " . _URL_);
}

$conn = new Conecta($app);
$config = $conn->get_dados_de_autenticacao();

$client_id      = isset($config['client_id']) ? $config['client_id'] : '';
$client_secret  = isset($config['client_secret']) ? $config['client_secret'] : '';
$callback       = isset($config['callback']) ? $config['callback'] : '';
$code           = isset($config['code']) ? $config['code'] : '';
$refresh_token  = isset($config['refresh_token']) ? $config['refresh_token'] : '';

if (!$client_id  || !$client_secret || !$callback) {
  include_once(__DIR__ . "/credenciais/create.php");
} else if (!$code || !$refresh_token) {

  include_once(__DIR__ . "/credenciais/autenticar_app.php");
}

include_once(__DIR__ . "/includes/footer.php");
