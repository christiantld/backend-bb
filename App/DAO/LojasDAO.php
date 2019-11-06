<?php

namespace App\DAO;

use App\Models\LojaModel;

class LojasDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllLojas(): array
  {
    $lojas = $this->pdo
      ->query('SELECT 
              id,
              nome, 
              telefone, 
              endereco 
              FROM lojas;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $lojas;
  }

  public function insertLoja(LojaModel $loja): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO lojas VALUES(
                  null,
                  :nome,
                  :telefone,
                  :endereco
            );');

    $statement->execute([
      'nome' => $loja->getNome(),
      'telefone' => $loja->getTelefone(),
      'endereco' => $loja->getEndereco(),
    ]);
  }

  public function updateLoja(LojaModel $loja): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE lojas SET
        nome = :nome,
        endereco = :endereco,
        telefone = :telefone
        WHERE
        id = :id 
        ;)');

    $statement->execute([
      'nome' => $loja->getNome(),
      'endereco' => $loja->getEndereco(),
      'telefone' => $loja->getTelefone(),
      'id' => $loja->getId()
    ]);
  }

  public function deleteLoja(int $id): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM produtos WHERE loja_id = :id;
      DELETE FROM lojas WHERE id = :id;');

    $statement->execute([
      'id' => $id
    ]);
  }
}