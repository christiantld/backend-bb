<?php

namespace App\DAO;

use App\Models\FornecedorModel;

class FornecedorDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getFornecedorById(int $id): ?FornecedorModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      pk_fornecedor,  
      no_fornecedor,
      email, 
      telefone, 
      FROM tb_fornecedor
      WHERE pk_fornecedor = :id;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $fornecedores = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($fornecedores) === 0)
      return null;

    $fornecedor = new FornecedorModel();
    $fornecedor->setPk_fornecedor($fornecedor['pk_fornecedor'])
      ->setNo_fornecedor($fornecedores['no_fornecedor'])
      ->setEmail($fornecedor['email'])
      ->setTelefone($fornecedor['telefone']);
    return $fornecedor;
  }

  public function getAllFornecedores(): array
  {
    $fornecedores = $this->pdo
      ->query('SELECT 
              *
              FROM tb_fornecedor;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $fornecedores;
  }

  public function insertFornecedor(FornecedorModel $fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_fornecedor (no_fornecedor, email, telefone) 
                  VALUES(
                  :no_fornecedor,
                  :email,
                  :telefone
            );');

    $statement->execute([
      'no_fornecedor' => $fornecedor->getNo_fornecedor(),
      'email' => $fornecedor->getEmail(),
      'telefone' => $fornecedor->getTelefone()
    ]);
  }

  public function updateFornecedor(FornecedorModel $fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_fornecedor SET 
      pk_fornecedor = :pk_fornecedor,
      no_fornecedor = :no_fornecedor,
      email = :email,
      telefone = :telefone
      WHERE 
          pk_fornecedor = :pk_fornecedor 
        ;');

    $statement->execute([
      'pk_fornecedor' => $fornecedor->getPk_fornecedor(),
      'no_fornecedor' => $fornecedor->getNo_fornecedor(),
      'email' => $fornecedor->getEmail(),
      'telefone' => $fornecedor->getTelefone()
    ]);
  }

  public function deleteFornecedor(int $pk_fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_fornecedor WHERE pk_fornecedor = :id;');

    $statement->execute([
      'id' => $pk_fornecedor
    ]);
  }
}