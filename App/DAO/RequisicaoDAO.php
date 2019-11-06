<?php

namespace App\DAO;

use App\Models\ProdutoModel;
use App\Models\RequisicaoModel;

class ProdutoDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllRequisicoes(): array
  {
    $requisicoes = $this->pdo
      ->query('SELECT 
            *
            FROM tb_requisicao;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $requisicoes;
  }

  public function getRequisicaoById(int $id): ?RequisicaoModel
  {
    $statement = $this->pdo->prepare(
      'SELECT
      data_requisicao,
      fk_funcionario_solicitante,
      fk_funcionario_movimentacao
      FROM tb_requisicao WHERE pk_requisicao = :id;'
    );

    $statement->bindParam('id', $id);
    $statement->execute();
    $requisicoes = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($requisicoes) === 0)
      return null;

    $requisicao = new RequisicaoModel();
    $requisicao->setData_requisicao($requisicoes[0]['data_requisicao'])
      ->setFk_funcionario_solicitante($requisicoes[0]['fk_funcionario_solicitante'])
      ->setFk_funcionario_movimentacao($requisicoes[0]['fk_funcionario_movimentacao']);
  }

  public function insertRequisicao(RequisicaoModel $requisicao): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_requisicao
              (data_requisicao, 
              fk_funcionario_solicitante,
              fk_funcionario_movimentacao)
              VALUES( 
              :data_requisicao, 
              :fk_funcionario_solicitacao, 
              :fk_funcionario_movimentacao);
    ');

    $statement->execute([
      'data_requisicao' => $requisicao->getData_requisicao(),
      'fk_funcionario_solicitante' => $requisicao->getFk_funcionario_solicitante(),
      'fk_funcionario_movimentacao' => $requisicao->getFk_funcionario_movimentacao()
    ]);
  }

  public function updateRequisicao(RequisicaoModel $requisicao): void
  {
    $statement = $this->pdo
      ->prepare(
        'UPDATE tb_requisicao SET
    pk_requisicao = :pk_requisicao,
    data_requisicao = :data_requisicao,
    fk_funcionario_solicitante = :fk_funcionario_solicitante,
    fk_funcionario_movimentacao = :fk_funcionario_movimentacao
    WHERE
    pk_requisicao = :pk_requisicao;'
      );

    $statement->execute([
      'pk_movimentacao' => $requisicao->getPk_requisicao(),
      'data_requisicao' => $requisicao->getData_requisicao(),
      'fk_funcionario_solicitante' => $requisicao->getFk_funcionario_solicitante(),
      'fk_funcionario_movimentacao' => $requisicao->getFk_funcionario_movimentacao()
    ]);
  }

  public function deleteRequisicao(int $pk_requisicao): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_requisicao WHERE pk_requisicao = :id;');

    $statement->execute([
      'id' => $pk_requisicao
    ]);
  }
}