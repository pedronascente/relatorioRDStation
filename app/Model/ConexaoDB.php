<?php

namespace App\Model;

use \PDO;

class ConexaoDB extends ConfigDb
{
	protected $_pdo;

	public function __construct()
	{
		parent::__construct(); // Chame o construtor da classe pai (ConfigDb) para obter as informações de configuração.

		// Tente criar a conexão com o banco de dados usando as informações fornecidas.
		try {
			$dsn = "mysql:host={$this->host};dbname={$this->db}";
			$this->_pdo = new PDO($dsn, $this->usuario, $this->senha);
		} catch (\PDOException $e) {
			die('Erro de conexão com o banco de dados: ' . $e->getMessage());
		}
	}

	public function getDB()
	{
		return $this->_pdo;
	}
}
