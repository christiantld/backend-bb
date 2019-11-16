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
      marca,
      qtd_minima,
      qtd_max,
      qtd_total,
      fk_categoria
      
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
      ->setMarca($produtos[0]['marca'])
      ->setDescricao($produto[0]['descricao'])
      ->setQtd_minima($produtos[0]['qtd_minima'])
      ->setQtd_max($produtos[0]['qtd_max'])
      ->setQtd_total($produtos[0]['qtd_total'])
      ->setFk_categoria($produtos[0]['fk_categoria']);
    return $produto;
  }

  public function getAllProdutos(): array
  {
    $produtos = $this->pdo
      ->query('SELECT 
              *
              FROM tb_produto;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $produtos;
  }

  public function insertProduto(ProdutoModel $produto): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_produto (no_produto, marca, descricao, qtd_minima, qtd_max, 
                            qtd_total, fk_categoria) 
                  VALUES(
                  :no_produto,
                  :marca,
                  :descricao,
                  :qtd_minima,
                  :qtd_max,
                  :qtd_total,
                  :fk_categoria
            );');

    $statement->execute([
      'no_produto' => $produto->getNo_Produto(),
      'marca' => $produto->getMarca(),
      'descricao' => $produto->getDescricao(),
      'qtd_minima' => $produto->getQtd_minima(),
      'qtd_max' => $produto->getQtd_max(),
      'qtd_total' => $produto->getQtd_total(),
      'fk_catogoria' => $produto->getFk_categoria()
    ]);
  }

  public function updateProduto(ProdutoModel $produto): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_produto SET 
      pk_produto = :pk_produto,
      no_produto = :no_produto,
      marca = :marca,
      descricao = :descricao,
      qtd_minima = :qtd_minima,
      qtd_max = :qtd_max,
      qtd_total = :qtd_total,
      fk_categoria = :fk_cateforia
      WHERE 
          pk_produto = :pk_produto 
        ;');

    $statement->execute([
      'pk_produto' => $produto->getPk_produto(),
      'no_produto' => $produto->getNo_Produto(),
      'marca' => $produto->getMarca(),
      'descricao' => $produto->getDescricao(),
      'qtd_minima' => $produto->getQtd_minima(),
      'qtd_max' => $produto->getQtd_max(),
      'qtd_total' => $produto->getQtd_total(),
      'fk_catogoria' => $produto->getFk_categoria()
    ]);
  }

  public function deleteProduto(int $pk_produto): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_lote WHERE fk_produto = :id;
      DELETE FROM tb_produto WHERE pk_produto = :id;');

    $statement->execute([
      'id' => $pk_produto
    ]);
  }
}