<?php
// Inicie a sessão PHP
session_start();

// Verifique se a sessão existe e, se existir, delete-a
if (isset($_SESSION['filtro'])) {
  unset($_SESSION['filtro']);
}
$filtro  = !empty($_POST['filtro']) ? $_POST['filtro'] : date('Y/m/d');

if ($filtro) {

  // Divida a data em dia, mês e ano
  $data = $filtro;
  list($dia, $mes, $ano) = explode('/', $data);

  // Reorganize a data no formato "Y-m-d"
  $filtro = date("Y-m-d", strtotime("$ano-$mes-$dia"));
  // Armazene o valor do filtro na sessão
  $_SESSION['filtro'] = $filtro;

  // Redirecione para a página relatorio.php
  header('Location: relatorio.php');
  exit; // Certifique-se de sair para evitar a execução adicional do código
}
