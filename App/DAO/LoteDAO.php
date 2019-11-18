<?php

namespace App\DAO;

use App\Models\LoteModel;

class LoteDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllLotes(): array
  {
    $lotes = $this->pdo
      ->query('SELECT 
        l.*,
        p.no_produto
        FROM tb_lote AS l
        INNER JOIN tb_produto AS p
        WHERE l.fk_produto = p.pk_produto;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $lotes;
  }

  public function getLoteById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT 
      l.*,
      p.no_produto
      FROM tb_lote AS l
      INNER JOIN tb_produto AS p
      WHERE l.fk_produto = p.pk_produto AND l.pk_lote = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $lote = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($lote) !== 1)
      return null;

    return $lote;
  }

  public function insertLote(LoteModel $lote): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_lote (
        data_fabricacao,
        lote,
        data_validade,
        fk_produto)
        VALUES (
          :data_fabricacao,
          :lote,
          :data_validade,
          :fk_produto);
    ');

    $statement->execute([
      'data_fabricacao' => $lote->getData_fabricacao(),
      'lote' => $lote->getLote(),
      'data_validade' => $lote->getData_validade(),
      'fk_produto' => $lote->getFk_produto()
    ]);
  }

  public function updateLote(LoteModel $lote): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_lote SET
    pk_lote = :pk_lote,
    data_fabricacao = :data_fabricacao,
    lote = :lote,
    data_validade= :data_validade,
    fk_produto = :fk_produto
    WHERE
    pk_lote = :pk_lote;
    ');

    $statement->execute([
      'pk_lote' => $lote->getPk_lote(),
      'data_fabricacao' => $lote->getData_fabricacao(),
      'lote' => $lote->getLote(),
      'data_validade' => $lote->getData_validade(),
      'fk_produto' => $lote->getFk_produto()
    ]);
  }

  public function deleteLote(int $pk_lote): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_lote WHERE pk_lote = :id;');

    $statement->execute([
      'id' => $pk_lote
    ]);
  }
}