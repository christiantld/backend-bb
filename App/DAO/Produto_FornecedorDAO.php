<?php

namespace App\DAO;

use App\Models\Produto_FornecedorModel;

class Produto_FornecedorDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllProduto_Fornecedor(): array
  {
    $produto_fornecedor = $this->pdo
      ->query('SELECT * FROM tb_produto_fornecedor;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $produto_fornecedor;
  }

  public function getProduto_FornecedorById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT
      pk_produto_fornecedor
      fk_produto,
      fk_fornecedor
      FROM tb_produto_fornecedor WHERE pk_produto_fornecedor = :id'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $produto_fornecedor = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($produto_fornecedor) !== 1)
      return null;

    return $produto_fornecedor;
  }

  public function insertProduto_Fornecedor(Produto_FornecedorModel $produto_fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_produto_fornecedor(
      fk_produto,
      fk_fornecedor)
      VALUES(
      :fk_produto,
      :fk_fornecedor);');

    $statement->execute([
      'fk_produto' => $produto_fornecedor->getFk_produto(),
      'fk_fornecedor' => $produto_fornecedor->getFk_fornecedor()
    ]);
  }

  public function updateProduto_Fornecedor(Produto_FornecedorModel $produto_fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_produto_fornecedor SET
    pk_produto_fornecedor = :pk_produto_fornecedor,
    fk_produto = :fk_produto,
    fk_fornecedor = :fk_fornecedor
    WHERE
    pk_produto_fornecedor = :pk_produto_fornecedor;
    ');

    $statement->execute([
      'pk_produto_fornecedor' => $produto_fornecedor->getPk_produto_fornecedor(),
      'fk_produto' => $produto_fornecedor->getFk_produto(),
      'fk_fornecedor' => $produto_fornecedor->getFk_fornecedor()
    ]);
  }
  public function deleteProduto_Fornecedor(int $pk_produto_fornecedor): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_produto_fornecedor WHERE pk_produto_fornecedor = :id;');

    $statement->execute([
      'id' => $pk_produto_fornecedor
    ]);
  }
}