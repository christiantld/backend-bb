<?php

namespace App\DAO;

use App\Models\FuncionarioModel;

class FuncionarioDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getFuncionarioByEmail(string $email): ?FuncionarioModel
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      pk_funcionario,
      no_funcionario, 
      nu_cpf, 
      email,
      senha,
      telefone, 
      fk_cargo
      FROM tb_funcionario
      WHERE email = :email;'
    );
    $statement->bindParam('email', $email);
    $statement->execute();
    $funcionarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($funcionarios) === 0)
      return null;

    $funcionario = new FuncionarioModel();
    $funcionario->setPk_funcionario($funcionarios[0]['pk_funcionario'])
      ->setNo_funcionario($funcionarios[0]['no_funcionario'])
      ->setNu_cpf($funcionarios[0]['nu_cpf'])
      ->setEmail($funcionarios[0]['email'])
      ->setSenha($funcionarios[0]['senha'])
      ->setTelefone($funcionarios[0]['telefone'])
      ->setFk_cargo($funcionarios[0]['fk_cargo']);
    return $funcionario;
  }

  public function getAllFuncionarios(): array
  {
    $funcionario = $this->pdo
      ->query('SELECT 
              pk_funcionario,
              no_funcionario, 
              nu_cpf, 
              email,
              telefone, 
              fk_cargo
              FROM tb_funcionario;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $funcionario;
  }

  public function insertFuncionario(FuncionarioModel $funcionario): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_funcionario (no_funcionario, nu_cpf, telefone, email, senha, fk_cargo) VALUES(
                  :no_funcionario,
                  :nu_cpf,
                  :telefone,
                  :email,
                  :senha,
                  :fk_cargo
            );');

    $statement->execute([
      'no_funcionario' => $funcionario->getNo_funcionario(),
      'nu_cpf' => $funcionario->getNu_cpf(),
      'telefone' => $funcionario->getTelefone(),
      'email' => $funcionario->getEmail(),
      'senha' => $funcionario->getSenha(),
      'fk_cargo' => $funcionario->getFk_cargo()
    ]);
  }

  public function updateLoja(FuncionarioModel $funcionario): void
  {
    $statement = $this->pdo
      ->prepare(
        'UPDATE tb_funcionario SET 
      pk_funcionario = :pk_funcionario,
      no_funcionario = :no_funcionario,
      nu_cpf = :nu_cpf,
      telefone = :telefone,
      senha = :senha,
      fk_cargo = :fk_cargo
      WHERE 
          pk_funcionario = :pk_funcionario ;'
      );

    $statement->execute([
      'pk_funcionario' => $funcionario->getPk_funcionario(),
      'no_funcionario' => $funcionario->getNo_funcionario(),
      'nu_cpf' => $funcionario->getNu_cpf(),
      'telefone' => $funcionario->getTelefone(),
      'senha' => $funcionario->getSenha(),
      'fk_cargo' => $funcionario->getFk_cargo()
    ]);
  }

  public function deleteFuncionario(int $pk_funcionario): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_token WHERE fk_funcionario = :id;
      DELETE FROM tb_funcionario WHERE pk_funcionario = :id;');

    $statement->execute([
      'id' => $pk_funcionario
    ]);
  }
}
// DELETE FROM tb_token WHERE fk_funcionario = :id;