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
        *
        FROM tb_lote;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $lotes;
  }

  public function getLoteById(int $id): ?LoteModel
  {
    $statement = $this->pdo->prepare(
      'SELECT 
    data_fabricacao,
    lote,
    data_validade,
    valor_item,
    fk_produto
    FROM tb_lote WHERE pk_lote = :id;
    '
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $lotes = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($lotes) === 0)
      return null;

    $lote = new LoteModel();
    $lote->setData_fabricacao($lotes[0]['data_fabricacao'])
      ->setLote($lotes[0]['lote'])
      ->setData_validade($lotes[0]['lote'])
      ->setValor_item($lote[0]['valor_item'])
      ->setFk_produto($lote[0]['fk_produto']);
    return $lote;
  }

  public function insertLote(LoteModel $lote): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_lote (
        data_fabricacao,
        lote,
        valor_item,
        fk_produto)
        VALUES (
          :data_fabricacao,
          :lote,
          :valor_item,
          :fk_produto);
    ');

    $statement->execute([
      'data_fabricacao' => $lote->getData_fabricacao(),
      'lote' => $lote->getLote(),
      'valor_item' => $lote->getValor_item(),
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
    valor_item = :valor_item,
    fk_produto = :fk_produto
    WHERE
    pk_lote = :pk_lote;
    ');

    $statement->execute([
      'pk_lote' => $lote->getPk_lote(),
      'data_fabricacao' => $lote->getData_fabricacao(),
      'lote' => $lote->getLote(),
      'valor_item' => $lote->getValor_item(),
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