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
      ->query('SELECT e.*, p.no_produto, u.no_usuario, f.no_fornecedor 
      FROM tb_entrada AS e 
      INNER JOIN tb_produto AS p 
      INNER JOIN tb_usuario as u 
      INNER JOIN tb_fornecedor AS f 
      WHERE e.fk_produto = p.pk_produto 
      AND e.fk_usuario = u.pk_usuario 
      AND e.fk_fornecedor = f.pk_fornecedor')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $entradas;
  }

  public function getEntradabyId(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT e.*, p.no_produto, u.no_usuario, f.no_fornecedor 
      FROM tb_entrada AS e 
      INNER JOIN tb_produto AS p 
      INNER JOIN tb_usuario as u 
      INNER JOIN tb_fornecedor AS f 
      WHERE e.fk_produto = p.pk_produto 
      AND e.fk_usuario = u.pk_usuario 
      AND e.fk_fornecedor = f.pk_fornecedor AND pk_entrada = :id
      ORDER BY pk_entrada DESC;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $entrada = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($entrada) !== 1)
      return null;

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
      WHERE
        pk_entrada = :pk_entrada;
    ');

    $statement->execute([
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