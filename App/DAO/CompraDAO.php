<?php

namespace App\DAO;

use App\Models\CompraModel;

class CompraDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllCompras(): array
  {
    $compras = $this->pdo
      ->query('SELECT 
          *
          FROM tb_compra;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $compras;
  }

  public function getComprabyId(int $id): ?CompraModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      nu_valor,
      dt_compra,
      fk_fornecedor,
      fk_funcionario_solicitante,
      fk_funcionario_movimentacao
      FROM tb_compra WHERE pk_compra = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $compras = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($compras) === 0)
      return null;

    $compra = new CompraModel();
    $compra->setNu_valor($compras[0]['nu_valor'])
      ->setDt_compra($compras[0]['dt_compra'])
      ->setFk_fornecedor($compras[0]['fk_fornecedor'])
      ->setFk_funcionario_solicitante($compras[0]['fk_funcionario_solicitante'])
      ->setFk_funcionario_movimentacao($compras[0]['fk_funcionario_movimentacao']);
    return $compra;
  }

  public function insertCompra(CompraModel $compra): void
  {
    $statement = $this->pdo
      ->prepare(' INSERT INTO tb_compra (nu_valor, 
                dt_compra,
                fk_fornecedor, 
                fk_funcionario_solicitante, 
                fk_funcionario_movimentacao)
    VALUES(
      :nu_valor,
      :dt_compra,
      :fk_fornecedor,
      :fk_funcionario_solicitante,
      :fk_funcionario_movimentacao
    );');

    $statement->execute([
      'nu_valor' => $compra->getNu_valor(),
      'dt_compra' => $compra->getDt_compra(),
      'fk_fornecedor' => $compra->getFk_fornecedor(),
      'fk_funcionario_solicitante' => $compra->getFk_funcionario_solicitante(),
      'fk_funcionario_movimentacao' => $compra->getFk_funcionario_movimentacao(),
    ]);
  }

  public function updateCompra(CompraModel $compra): void
  {
    $statement = $this->pdo
      ->prepare(' UPDATE tb_compra SET
      pk_compra = :pk_compra,
      nu_valor = :nu_valor,
      dt_compra = :dt_compra,
      fk_fornecedor = :fk_fornecedor,
      fk_funcionario_solicitante = :fk_funcionario_solicitante,
      fk_funcionario_movimentacao = :fk_funcionario_movimentacao
      WHERE
        pk_compra = :pk_compra;
    ');

    $statement > execute([
      'pk_compra' => $compra->getPk_compra(),
      'nu_valor' => $compra->getNu_valor(),
      'dt_compra' => $compra->getDt_compra(),
      'fk_fornecedor' => $compra->getFk_fornecedor(),
      'fk_funcionario_solicitante' => $compra->getFk_funcionario_solicitante(),
      'fk_funcionario_movimentacao' => $compra->getFk_funcionario_movimentacao(),
    ]);
  }

  public function deleteCompra(int $pk_compra): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_compra WHERE pk_compra = :id;');

    $statement->execute([
      'id' => $pk_compra
    ]);
  }
}