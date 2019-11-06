<?php

namespace App\DAO;

use App\Models\ProdutoModel;

class ProdutoDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getProdutoById(int $id): ?ProdutoModel
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      no_produto,
      descricao,
      qtd_minima
      qtd_total,
      fk_categoria,
      fk_fornecedor
      FROM tb_produto
      WHERE pk_produto = :id;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $produtos = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($produtos) === 0)
      return null;

    $produto = new ProdutoModel();
    $produto->setNo_Produto($produtos[0]['no_produto'])
      ->setDescricao($produto[0]['descricao'])
      ->setQtd_minima($produtos[0]['qtd_minima'])
      ->setQtd_total($produtos[0]['qtd_total'])
      ->setFk_categoria($produtos[0]['fk_categoria'])
      ->setFk_fornecedor($produtos[0]['fk_fornecedor']);
    return $produto;
  }

  public function getAllProdutos(): array
  {
    $produtos = $this->pdo
      ->query('SELECT 
              *
              FROM tb_Produto;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $produtos;
  }

  public function insertProduto(ProdutoModel $produto): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_produto (no_produto, descricao, qtd_minima, 
                            qtd_total, fk_categoria, fk_fornecedor) 
                  VALUES(
                  :no_produto,
                  :descricao,
                  :qtd_minima,
                  :qtd_total,
                  :fk_categoria,
                  :fk_fornecedor
            );');

    $statement->execute([
      'no_produto' => $produto->getNo_Produto(),
      'descricao' => $produto->getDescricao(),
      'qtd_minima' => $produto->getQtd_minima(),
      'qtd_total' => $produto->getQtd_total(),
      'fk_catogoria' => $produto->getFk_categoria(),
      'fk_fornecedor' => $produto->getFk_fornecedor()
    ]);
  }

  public function updateProduto(ProdutoModel $produto): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_produto SET 
      pk_produto = :pk_produto,
      no_produto = :no_produto
      descricao = :descricao,
      qtd_minima = :qtd_minima,
      qtd_total = :qtd_total,
      fk_categoria = :fk_cateforia,
      fk_fornecedor = :fk_fornecedor
      WHERE 
          pk_produto = :pk_produto 
        ;');

    $statement->execute([
      'pk_produto' => $produto->getPk_produto(),
      'no_produto' => $produto->getNo_Produto(),
      'descricao' => $produto->getDescricao(),
      'qtd_minima' => $produto->getQtd_minima(),
      'qtd_total' => $produto->getQtd_total(),
      'fk_catogoria' => $produto->getFk_categoria(),
      'fk_fornecedor' => $produto->getFk_fornecedor()
    ]);
  }

  public function deleteProduto(int $pk_produto): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_produto WHERE pk_produto = :id;');

    $statement->execute([
      'id' => $pk_produto
    ]);
  }
}