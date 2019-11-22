<?php

namespace App\DAO;

use App\Models\TokenModel;

class TokensDAO extends Conexao
{
  public function __construct()
  {
    parent::__construct();
  }

  public function createToken(TokenModel $token): void
  {
    $statement = $this->pdo
      ->prepare('INSERT INTO tb_token 
      (
        token, 
        refresh_token, 
        expire_at, 
        fk_usuario
      )
      VALUES
      (
        :token,
        :refresh_token,
        :expire_at,
        :fk_usuario
      );
      ');

    $statement->execute([
      'token' => $token->getToken(),
      'refresh_token' => $token->getRefresh_token(),
      'expire_at' => $token->getExpire_at(),
      'fk_usuario' => $token->getFk_usuario()
    ]);
  }

  public function verifyRefreshToken(string $refreshToken): bool
  {
    $statement = $this->pdo
      ->prepare('SELECT
        pk_token
        FROM tb_token
        WHERE refresh_token = :refresh_token AND active = 1
      ');
    $statement->bindParam('refresh_token', $refreshToken);
    $statement->execute();
    $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
    return count($tokens) === 0 ? false : true;
  }

  public function inactiveToken(string $token): void
  {
    $statement = $this->pdo
      ->prepare('UPDATE tb_token SET active = 0 WHERE token = :token');

    $statement->execute([
      'token' => $token->getToken()
    ]);
  }
}