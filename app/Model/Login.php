<?php

namespace App\Model;

use App\Model\ConexaoDB;

class Login
{
	private $_pdo;
	private $_table = "usuario";

	function __construct()
	{
		$conn = new ConexaoDB();
		$this->_pdo = $conn->getDB();
	}

	public function getBydadosAcesso($array_dados)
	{
		$dados = [
			'usuario' => 'Administrador',
			'email' => 'admin@rd.com.br',
			'password' => 123
		];

		if (in_array($array_dados['email'], $dados)  &&  in_array($array_dados['password'], $dados)) {
			$result = $dados;
		} else {
			$result = null;
		}

		return $result;
	}
}
