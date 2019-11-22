<?php

namespace App\Controllers;

use App\DAO\TokensDAO;
use App\DAO\UsuarioDAO;
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

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getUsuarioByEmail($email);
    if (is_null($usuario))
      return $response->withStatus(401);

    // ERRO password verify 
    $hash = $usuario->getSenha();
    if ($senha !== $hash)
      return $response->withStatus(401);

    $expiredAt = (new \DateTime())->modify('+2 days')
      ->format('Y-m-d H:i:s');

    $tokenPayload = [
      'id' => $usuario->getPk_usuario(),
      'name' => $usuario->getNo_usuario(),
      'email' => $usuario->getEmail(),
      'cargo' => $usuario->getFk_cargo(),
      'expire_at' => $expiredAt
    ];
    // Gera um Token
    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      'email' => $usuario->getEmail(),
      'random' => uniqid()
    ];

    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

    $tokenModel = new TokenModel();
    $tokenModel->setExpire_at($expiredAt)
      ->setRefresh_token($refreshToken)
      ->setToken($token)
      ->setFk_usuario($usuario->getPk_usuario());

    $tokenDAO = new TokensDAO();
    $tokenDAO->createToken($tokenModel);

    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken,
      "usuario" => $usuario->getNo_usuario(),
      "id" => $usuario->getPk_usuario(),
      "email" => $usuario->getEmail(),
      "cargo" => $usuario->getFk_cargo()
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
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getUsuarioByEmail($refreshTokenDecoded->email);

    if (is_null($usuario))
      return $response->withStatus(401);

    $expiredAt = (new \DateTime())->modify('+2 days')
      ->format('Y-m-d H:i:s');
    $tokenPayload = [
      'id' => $usuario->getPk_usuario(),
      'name' => $usuario->getNo_usuario(),
      'email' => $usuario->getEmail(),
      'cargo' => $usuario->getFk_cargo(),
      'expire_at' => $expiredAt
    ];

    $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

    $refreshTokenPayload = [
      'email' => $usuario->getEmail(),
      'random' => uniqid()
    ];

    $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

    $tokenModel = new TokenModel();
    $tokenModel->setExpire_at($expiredAt)
      ->setRefresh_token($refreshToken)
      ->setToken($token)
      ->setFk_usuario($usuario->getPk_usuario());

    $tokenDAO = new TokensDAO();
    $tokenDAO->createToken($tokenModel);

    $response = $response->withJson([
      "token" => $token,
      "refresh_token" => $refreshToken
    ]);

    return $response;
  }
}