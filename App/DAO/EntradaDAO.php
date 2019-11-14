<?php

namespace App\DAO;

use App\Models\EntradaModel;

class EntradaDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getAllEntradas(): array
  {
    $entradas = $this->pdo
      ->query('SELECT 
          *
          FROM tb_entrada;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $entradas;
  }

  public function getEntradabyId(int $id): ?EntradaModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      data_entrada,
      qtd_item,
      valor_item,
      fk_produto,
      fk_usuario
      fk_fornecedor,
      FROM tb_entrada WHERE pk_entrada = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $entradas = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($entradas) === 0)
      return null;

    $entrada = new EntradaModel();
    $entrada->setData_entrada($entradas[0]['data_entrada'])
      ->setQtd_item($entradas[0]['qtd_item'])
      ->setValor_item($entradas[0]['valor_item'])
      ->setFk_produto($entradas[0]['fk_produto'])
      ->setFk_usuario($entradas[0]['fk_usuario'])
      ->setFk_fornecedor($entradas[0]['fk_fornecedor']);
    return $entrada;
  }

  public function insertEntrada(EntradaModel $entrada): void
  {
    $statement = $this->pdo
      ->prepare(' INSERT INTO tb_entrada (data_entrada, 
                qtd_item,
                valor_item,
                fk_produto, 
                fk_usuario,
                fk_fornecedor
                )
    VALUES(
      :data_entrada,
      :qtd_item,
      :valor_item,
      :fk_produto,
      :fk_usuario,
      :fk_fornecedor
    );');

    $statement->execute([
      'data_entrada' => $entrada->getData_entrada(),
      'qtd_item' => $entrada->getQtd_item(),
      'valor_item' => $entrada->getValor_item(),
      'fk_produto' => $entrada->getFk_produto(),
      'fk_usuario' => $entrada->getFk_usuario(),
      'fk_fornecedor' => $entrada->getFk_fornecedor()
    ]);
  }

  public function updateEntrada(EntradaModel $entrada): void
  {
    $statement = $this->pdo
      ->prepare(' UPDATE tb_entrada SET
      pk_entrada = :pk_entrada,
      data_entrada = :data_entrada,
      qtd_item = :qtd_item,
      valor_item = :valor_item,
      fk_produto = :fk_produto,
      fk_usuario = :fk_usuario,
      fk_fornecedor = :fk_fornecedor
       = :
      WHERE
        pk_entrada = :pk_entrada;
    ');

    $statement > execute([
      'pk_entrada' => $entrada->getPk_entrada(),
      'data_entrada' => $entrada->getData_entrada(),
      'qtd_item' => $entrada->getQtd_item(),
      'valor_item' => $entrada->getValor_item(),
      'fk_produto' => $entrada->getFk_produto(),
      'fk_usuario' => $entrada->getFk_usuario(),
      'fk_fornecedor' => $entrada->getFk_fornecedor()
    ]);
  }

  public function deleteEntrada(int $pk_entrada): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_entrada WHERE pk_entrada = :id;');

    $statement->execute([
      'id' => $pk_entrada
    ]);
  }
}