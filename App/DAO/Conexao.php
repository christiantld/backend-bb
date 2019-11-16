<?php

namespace App\DAO;

abstract class Conexao
{
  /**
   * @var \PDO
   */
  protected $pdo;

  public function __construct()
  {
    $host = getenv('MYSQL_HOST');
    $port = getenv('MYSQL_PORT');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $dbname = getenv('MYSQL_DBNAME');

    $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

    $this->pdo = new \PDO($dsn, $user, $pass);
    $this->pdo->setAttribute(
      \PDO::ATTR_ERRMODE,
      \PDO::ERRMODE_EXCEPTION
    );
  }
}