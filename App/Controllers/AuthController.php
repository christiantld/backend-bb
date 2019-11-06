<?php

namespace App\Controllers;

use App\DAO\TokensDAO;
use App\DAO\FuncionarioDAO;
use App\Models\TokenModel;
use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

final class AuthController
{
  public function login(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $email = $data['email'];
    $senha = $data['senha'];

    $funcionarioDAO = new FuncionarioDAO();
    $funcionario = $funcionarioDAO->getFuncionarioByEmail($email);
    if (is_null($funcionario))
      return $response->withStatus(401);

    $hash = $funcionario->getSenha();
    if (!password_verify($senha, $hash))
      return $response->withStatus(401);

    $expiredAt = (new \DateTime())->modify('+2 days')
      ->format('Y-m-d H:i:s');

    $tokenPayload = [
      'id' => $funcionario->getPk_funcionario(),
      'name' => $funcionario->getNo_funcionario(),
      'email' => $funcionario->getEmail(),
      'cargo' => $funcionario->getFk_cargo(),
      'expire_at' => $expiredAt
    ];

    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      'email' => $funcionario->getEmail(),
      'random' => uniqid()
    ];

    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

    $tokenModel = new TokenModel();
    $tokenModel->setExpire_at($expiredAt)
      ->setRefresh_token($refreshToken)
      ->setToken($token)
      ->setFk_funcionario($funcionario->getPk_funcionario());

    $tokenDAO = new TokensDAO();
    $tokenDAO->createToken($tokenModel);

    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken
    ]);

    return $response;
  }

  public function refreshToken(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $refreshToken = $data['refresh_token'];

    $refreshTokenDecoded = JWT::decode(
      $refreshToken,
      getenv('JWT_SECRET_KEY'),
      ['HS256']
    );

    $tokensDAO = new TokensDAO();
    $refreshTokenExists = $tokensDAO->verifyRefreshToken($refreshToken);
    if (!$refreshTokenExists)
      return $response->withStatus(401);
    $funcionarioDAO = new FuncionarioDAO();
    $funcionario = $funcionarioDAO->getFuncionarioByEmail($refreshTokenDecoded->email);

    if (is_null($funcionario))
      return $response->withStatus(401);

    $expiredAt = (new \DateTime())->modify('+2 days')
      ->format('Y-m-d H:i:s');
    $tokenPayload = [
      'id' => $funcionario->getPk_funcionario(),
      'name' => $funcionario->getNo_funcionario(),
      'email' => $funcionario->getEmail(),
      'cargo' => $funcionario->getFk_cargo(),
      'expire_at' => $expiredAt
    ];

    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      'email' => $funcionario->getEmail(),
      'random' => uniqid()
    ];

    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

    $tokenModel = new TokenModel();
    $tokenModel->setExpire_at($expiredAt)
      ->setRefresh_token($refreshToken)
      ->setToken($token)
      ->setFk_funcionario($funcionario->getPk_funcionario());

    $tokenDAO = new TokensDAO();
    $tokenDAO->createToken($tokenModel);

    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken
    ]);

    return $response;
  }
}