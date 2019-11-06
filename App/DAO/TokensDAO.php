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
        fk_funcionario
      )
      VALUES
      (
        :token,
        :refresh_token,
        :expire_at,
        :fk_funcionario
      );
      ');

    $statement->execute([
      'token' => $token->getToken(),
      'refresh_token' => $token->getRefresh_token(),
      'expire_at' => $token->getExpire_at(),
      'fk_funcionario' => $token->getFk_funcionario()
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
}