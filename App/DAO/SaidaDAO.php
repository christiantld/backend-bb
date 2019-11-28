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
      ->query('SELECT s.*, p.no_produto, p.marca, u.no_usuario 
      FROM tb_saida AS s 
      INNER JOIN tb_produto as p 
      INNER JOIN tb_usuario as u 
      WHERE s.fk_produto = p.pk_produto 
      AND s.fk_usuario = u.pk_usuario
      ORDER BY pk_saida DESC;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $saidas;
  }

  public function getSaidabyId(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT s.*, p.no_produto, u.no_usuario 
      FROM tb_saida AS s 
      INNER JOIN tb_produto as p 
      INNER JOIN tb_usuario as u 
      WHERE s.fk_produto = p.pk_produto 
      AND s.fk_usuario = u.pk_usuario 
      AND s.pk_saida = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $saida = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($saida) !== 1)
      return null;

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