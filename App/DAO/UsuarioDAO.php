<?php

namespace App\DAO;

use App\Models\UsuarioModel;

class UsuarioDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getUsuarioByEmail(string $email): ?UsuarioModel
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      pk_usuario,
      no_usuario, 
      nu_cpf, 
      email,
      senha,
      telefone, 
      fk_cargo
      FROM tb_usuario
      WHERE email = :email;'
    );
    $statement->bindParam('email', $email);
    $statement->execute();
    $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($usuarios) === 0)
      return null;

    $usuario = new usuarioModel();
    $usuario->setPk_usuario($usuarios[0]['pk_usuario'])
      ->setNo_usuario($usuarios[0]['no_usuario'])
      ->setNu_cpf($usuarios[0]['nu_cpf'])
      ->setEmail($usuarios[0]['email'])
      ->setSenha($usuarios[0]['senha'])
      ->setTelefone($usuarios[0]['telefone'])
      ->setFk_cargo($usuarios[0]['fk_cargo']);
    return $usuarios;
  }

  public function getUsuarioById(int $id): ?array
  {
    $statement = $this->pdo->prepare(
      'SELECT  
      u.*,
      c.no_cargo
      FROM tb_usuario AS u
      INNER JOIN tb_cargo AS c
      WHERE u.fk_cargo = c.pk_cargo AND u.pk_usuario = :id;'
    );
    $statement->bindParam('id', $id);
    $statement->execute();
    $usuario = $statement->fetchAll(\PDO::FETCH_ASSOC);

    if (count($usuario) === 0)
      return null;

    return $usuario;
  }

  public function getAllUsuarios(): array
  {
    $usuario = $this->pdo
      ->query('SELECT  
      u.*,
      c.no_cargo
      FROM tb_usuario AS u
      INNER JOIN tb_cargo AS c
      WHERE u.fk_cargo = c.pk_cargo;')
      ->fetchAll(\PDO::FETCH_ASSOC);

    return $usuario;
  }

  public function insertUsuario(UsuarioModel $usuario): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_usuario (no_usuario, nu_cpf, telefone, email, senha, fk_cargo) VALUES(
                  :no_usuario,
                  :nu_cpf,
                  :telefone,
                  :email,
                  :senha,
                  :fk_cargo
            );');

    $statement->execute([
      'no_usuario' => $usuario->getNo_usuario(),
      'nu_cpf' => $usuario->getNu_cpf(),
      'telefone' => $usuario->getTelefone(),
      'email' => $usuario->getEmail(),
      'senha' => $usuario->getSenha(),
      'fk_cargo' => $usuario->getFk_cargo()
    ]);
  }

  public function updateUsuario(UsuarioModel $usuario): void
  {
    $statement = $this->pdo
      ->prepare(
        'UPDATE tb_usuario SET 
      pk_usuario = :pk_usuario,
      no_usuario = :no_usuario,
      nu_cpf = :nu_cpf,
      telefone = :telefone,
      email = :email,
      fk_cargo = :fk_cargo
      WHERE 
          pk_usuario = :pk_usuario ;'
      );

    $statement->execute([
      'pk_usuario' => $usuario->getPk_usuario(),
      'no_usuario' => $usuario->getNo_usuario(),
      'nu_cpf' => $usuario->getNu_cpf(),
      'telefone' => $usuario->getTelefone(),
      'email' => $usuario->getEmail(),
      'fk_cargo' => $usuario->getFk_cargo()
    ]);
  }

  public function deleteUsuario(int $pk_usuario): void
  {
    $statement = $this->pdo
      ->prepare('DELETE FROM tb_token WHERE fk_usuario = :id;
      DELETE FROM tb_usuario WHERE pk_usuario = :id;');

    $statement->execute([
      'id' => $pk_usuario
    ]);
  }
}
// DELETE FROM tb_token WHERE fk_usuario = :id;