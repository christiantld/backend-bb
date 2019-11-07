<?php

namespace App\DAO;

use App\Models\Item_RequisicaoModel;

class Item_RequisicaoDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getAllItems_Requisicao(): array
  {
    $items_requisicao = $this->pdo
      ->query('SELECT 
          *
          FROM tb_item_requisicao;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $items_requisicao;
  }

  public function getItem_RequisicaobyId(int $id): ?Item_RequisicaoModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      qtd_item,
      fk_produto,
      fk_requisicao,
      FROM tb_item_requisicao WHERE pk_item_requisicao = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $items_requisicao = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($items_requisicao) === 0)
      return null;

    $item_requisicao = new item_requisicaoModel();
    $item_requisicao->setQtd_item($items_requisicao[0]['qtd_item'])
      ->setFk_produto($items_requisicao[0]['fk_produto'])
      ->setFk_requisicao($items_requisicao[0]['fk_requisicao']);
    return $item_requisicao;
  }

  public function insertItem_Requisicao(Item_RequisicaoModel $item_requisicao): void
  {
    $statement = $this->pdo
      ->prepare(' INSERT INTO tb_item_requisicao ( 
                qtd_item,
                fk_produto, 
                fk_requisicao
                )
    VALUES(
      :qtd_item,
      :fk_produto,
      :fk_requisicao
    );');

    $statement->execute([
      'qtd_item' => $item_requisicao->getQtd_item(),
      'fk_produto' => $item_requisicao->getFk_produto(),
      'fk_requisicao' => $item_requisicao->getFk_requisicao(),
    ]);
  }

  public function updateItem_Requisicao(Item_RequisicaoModel $item_requisicao): void
  {
    $statement = $this->pdo
      ->prepare(' UPDATE tb_item_requisicao SET
      pk_item_requisicao = :pk_item_requisicao,
      qtd_item = :qtd_item,
      fk_produto = :fk_produto,
      fk_requisicao = :fk_requisicao
      WHERE
        pk_item_requisicao = :pk_item_requisicao;
    ');

    $statement->execute([
      'pk_item_requisicao' => $item_requisicao->getPk_item_requisicao(),
      'qtd_item' => $item_requisicao->getQtd_item(),
      'fk_produto' => $item_requisicao->getFk_produto(),
      'fk_requisicao' => $item_requisicao->getFk_requisicao(),
    ]);
  }

  public function deleteItem_Requisicao(int $pk_item_requisicao): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_item_requisicao WHERE pk_item_requisicao = :id;');

    $statement->execute([
      'id' => $pk_item_requisicao
    ]);
  }
}