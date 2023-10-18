<?php

namespace App\Model;

use \PDO;
use PDOException;
use App\Model\ConexaoDB;

class Relatorio
{
  private $conexao;

  public function __construct()
  {
    $this->conexao = new ConexaoDB();
  }

  public function insert(array $data)
  {
    try {
      $sql = "INSERT INTO relatorio (empresa, servico, campanha, name, email, cor, created_at) VALUES (:empresa, :servico, :campanha, :name, :email, :cor, :created_at)";
      $stmt = $this->conexao->getDB()->prepare($sql);
      $stmt->bindParam(':empresa', $data['empresa']);
      $stmt->bindParam(':servico', $data['servico']);
      $stmt->bindParam(':campanha', $data['campanha']);
      $stmt->bindParam(':name', $data['name']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':cor', $data['cor']);
      $stmt->bindParam(':created_at', $data['created_at']);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      // Lidar com erros, como registro duplicado, chave estrangeira inexistente, etc.
      return false;
    }
  }

  public function existeContato(array $contato)
  {
    try {
      $sql = "SELECT COUNT(*) FROM relatorio WHERE email = :email";
      $stmt = $this->conexao->getDB()->prepare($sql);
      $stmt->bindParam(':email', $contato['email']);
      $stmt->execute();
      $count = $stmt->fetchColumn();
      return $count > 0; // Retorna true se já existe um registro com o mesmo email
    } catch (PDOException $e) {
      // Lidar com erros, como erro na consulta, conexão com o banco de dados, etc.
      return false;
    }
  }

  public function gerarRelatorio($filtro_data = '')
  {
    $filtro_data = !empty($filtro_data) ? $filtro_data : date('Y-m-d');

    try {
      $sql = "SELECT empresa, campanha, cor, COUNT(created_at) AS total FROM relatorio WHERE created_at = :data GROUP BY empresa, campanha ORDER BY cor";
      $stmt = $this->conexao->getDB()->prepare($sql);
      $stmt->bindParam(':data', $filtro_data);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      // Lidar com erros, como erro na consulta, conexão com o banco de dados, etc.
      return false;
    }
  }
}
