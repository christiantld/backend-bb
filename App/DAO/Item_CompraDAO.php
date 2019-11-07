<?php

namespace App\DAO;

use App\Models\Item_CompraModel;

class Item_CompraDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getAllItems_compra(): array
  {
    $item_compras = $this->pdo
      ->query('SELECT 
          *
          FROM tb_item_compra;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $item_compras;
  }

  public function getItem_ComprabyId(int $id): ?Item_CompraModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      data_entrada,
      qtd_item,
      fk_produto,
      fk_compra,
      FROM tb_item_compra WHERE pk_item_compra = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $item_compras = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($item_compras) === 0)
      return null;

    $item_compra = new item_compraModel();
    $item_compra->setData_entrada($item_compras[0]['data_entrada'])
      ->setQtd_item($item_compras[0]['qtd_item'])
      ->setFk_produto($item_compras[0]['fk_produto'])
      ->setFk_compra($item_compras[0]['fk_compra']);
    return $item_compra;
  }

  public function insertItem_compra(Item_CompraModel $item_compra): void
  {
    $statement = $this->pdo
      ->prepare(' INSERT INTO tb_item_compra (data_entrada, 
                qtd_item,
                fk_produto, 
                fk_compra
                )
    VALUES(
      :data_entrada,
      :qtd_item,
      :fk_produto,
      :fk_compra
    );');

    $statement->execute([
      'data_entrada' => $item_compra->getData_entrada(),
      'qtd_item' => $item_compra->getQtd_item(),
      'fk_produto' => $item_compra->getFk_produto(),
      'fk_compra' => $item_compra->getFk_compra(),
    ]);
  }

  public function updateItem_Compra(Item_CompraModel $item_compra): void
  {
    $statement = $this->pdo
      ->prepare(' UPDATE tb_item_compra SET
      pk_item_compra = :pk_item_compra,
      data_entrada = :data_entrada,
      qtd_item = :qtd_item,
      fk_produto = :fk_produto,
      fk_compra = :fk_compra,
       = :
      WHERE
        pk_item_compra = :pk_item_compra;
    ');

    $statement > execute([
      'pk_item_compra' => $item_compra->getPk_item_compra(),
      'data_entrada' => $item_compra->getData_entrada(),
      'qtd_item' => $item_compra->getQtd_item(),
      'fk_produto' => $item_compra->getFk_produto(),
      'fk_compra' => $item_compra->getFk_compra(),
    ]);
  }

  public function deleteItem_Compra(int $pk_item_compra): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_item_compra WHERE pk_item_compra = :id;');

    $statement->execute([
      'id' => $pk_item_compra
    ]);
  }
}