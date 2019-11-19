<?php

namespace App\DAO;

use App\Models\EntradaModel;
use App\Models\SaidaModel;
use App\Models\ProdutoModel;

class ProdutoDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getProdutoById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT
      p.*,
      c.no_categoria
      FROM tb_produto as p
      INNER JOIN tb_categoria as c
      WHERE p.pk_produto = :id AND c.pk_categoria = p.fk_categoria;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $produto = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($produto) !== 1)
      return null;

    return $produto;
  }

  public function getAllProdutos(): array
  {
    $produtos = $this->pdo
      ->query('SELECT p.*, c.no_categoria 
      FROM tb_produto AS p 
      INNER JOIN tb_categoria as c 
      WHERE c.pk_categoria = p.fk_categoria')
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
      'no_produto' => $produto->getNo_produto(),
      'marca' => $produto->getMarca(),
      'descricao' => $produto->getDescricao(),
      'qtd_minima' => $produto->getQtd_minima(),
      'qtd_max' => $produto->getQtd_max(),
      'qtd_total' => $produto->getQtd_total(),
      'fk_categoria' => $produto->getFk_categoria()
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
      fk_categoria = :fk_categoria
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
      'fk_categoria' => $produto->getFk_categoria()
    ]);
  }

  public function addProduto(ProdutoModel $produto, EntradaModel $entrada, int $qtd_item): void
  {

    $statement = $this->pdo
      ->prepare('UPDATE tb_produto SET 
      qtd_total = :qtd_total
      WHERE 
          pk_produto = :fk_produto 
        ;');

    $total = ((int) $produto->getQtd_total() - $qtd_item) + (int) $entrada->getQtd_item();

    $statement->execute([
      'qtd_total' => $total,
      'fk_produto' => $entrada->getFk_produto()
    ]);
    print_r("(" . (int) $produto->getQtd_total() . "-" . $qtd_item . ")" . "+" . $entrada->getQtd_item() . "=" . $total);
  }

  public function removeProduto(ProdutoModel $produto, SaidaModel $saida, Int $qtd_item): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_produto SET 
      qtd_total = :qtd_total
      WHERE 
          pk_produto = :fk_produto 
        ;');
    $total = ((int) $produto->getQtd_total() + $qtd_item) - $saida->getQtd_item();

    $statement->execute([
      'qtd_total' => $total,
      'fk_produto' => $saida->getFk_produto()
    ]);
    print_r("(" . (int) $produto->getQtd_total() . "+" . $qtd_item . ")" . "-" . $saida->getQtd_item() . "=" . $total);
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