<?php

namespace App\Controllers;

use App\DAO\UsuarioDAO;
use App\Models\UsuarioModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class UsuarioController
{
  public function getUsuarios(Request $request, Response $response, array $args): Response
  {
    $usuarioDAO = new UsuarioDAO();
    $usuarios = $usuarioDAO->getAllUsuarios();
    $response = $response->withJson($usuarios);

    return $response;
  }

  public function insertUsuario(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $usuarioDAO = new UsuarioDAO();
    $usuario = new UsuarioModel();
    $usuario
      ->setNo_usuario($data['no_usuario'])
      ->setNu_cpf($data['nu_cpf'])
      ->setEmail($data['email'])
      ->setSenha($data['senha'])
      ->setTelefone($data['telefone'])
      ->setFk_cargo($data['fk_cargo']);
    $usuarioDAO->insertUsuario($usuario);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);
    return $response;
  }

  public function updateUsuario(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $usuarioDAO = new UsuarioDAO();
    $usuario = new UsuarioModel();
    $usuario->setPk_usuario((int) $data['pk_usuario'])
      ->setNo_usuario($data['no_usuario'])
      ->setNu_cpf($data['nu_cpf'])
      ->setEmail($data['email'])
      ->setTelefone($data['telefone'])
      ->setFk_cargo($data['fk_cargo']);
    $usuarioDAO->updateUsuario($usuario);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteUsuario(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $usuarioDAO = new UsuarioDAO;
    $id = (int) $queryParams['id'];
    $usuarioDAO->deleteUsuario($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }

  public function getUsuarioByEmail(Request $request, Response $response, array $args): Response
  {
    $token = $request->getAttribute('jwt');
    $email = $token['email'];
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getUsuarioByEmail($email);
    echo '<pre>';
    var_dump($usuario);
    $response = $response->withJson($usuario);
    return $response;
  }
}