<?php

namespace App\DAO;

use App\Models\SaidaModel;

class SaidaDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getAllSaidas(): array
  {
    $saidas = $this->pdo
      ->query('SELECT 
          *
          FROM tb_saida;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $saidas;
  }

  public function getSaidabyId(int $id): ?SaidaModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      qtd_item,
      data_saida,
      fk_produto,
      fk_usuario,
      FROM tb_saida WHERE pk_saida = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $saidas = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($saidas) === 0)
      return null;

    $saida = new SaidaModel();
    $saida->setQtd_item($saidas[0]['qtd_item'])
      ->setData_saida($saidas[0]['data_saida'])
      ->setFk_produto($saidas[0]['fk_produto'])
      ->setFk_usuario($saidas[0]['fk_usuario']);
    return $saida;
  }

  public function insertSaida(SaidaModel $saida): void
  {
    $statement = $this->pdo
      ->prepare(' INSERT INTO tb_saida ( 
                qtd_item,
                data_saida,
                fk_produto, 
                fk_usuario
                )
    VALUES(
      :qtd_item,
      :data_saida,
      :fk_produto,
      :fk_usuario
    );');

    $statement->execute([
      'qtd_item' => $saida->getQtd_item(),
      'data_saida' => $saida->getData_saida(),
      'fk_produto' => $saida->getFk_produto(),
      'fk_usuario' => $saida->getFk_usuario()
    ]);
  }

  public function updatesaida(SaidaModel $saida): void
  {
    $statement = $this->pdo
      ->prepare(' UPDATE tb_saida SET
      pk_saida = :pk_saida,
      qtd_item = :qtd_item,
      data_saida = :data_saida,
      fk_produto = :fk_produto,
      fk_usuario = :fk_usuario
      WHERE
        pk_saida = :pk_saida;
    ');

    $statement->execute([
      'pk_saida' => $saida->getPk_saida(),
      'qtd_item' => $saida->getQtd_item(),
      'data_saida' => $saida->getData_saida(),
      'fk_produto' => $saida->getFk_produto(),
      'fk_usuario' => $saida->getFk_usuario()
    ]);
  }

  public function deletesaida(int $pk_saida): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_saida WHERE pk_saida = :id;');

    $statement->execute([
      'id' => $pk_saida
    ]);
  }
}