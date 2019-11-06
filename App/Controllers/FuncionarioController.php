<?php

namespace App\Controllers;

use App\DAO\FuncionarioDAO;
use App\Models\FuncionarioModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class FuncionarioController
{
  public function getFuncionarios(Request $request, Response $response, array $args): Response
  {
    $funcionarioDAO = new FuncionarioDAO();
    $funcionarios = $funcionarioDAO->getAllFuncionarios();
    $response = $response->withJson($funcionarios);

    return $response;
  }

  public function insertFuncionario(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $funcionarioDAO = new FuncionarioDAO();
    $funcionario = new FuncionarioModel();
    $funcionario
      ->setNo_funcionario($data['no_funcionario'])
      ->setNu_cpf($data['nu_cpf'])
      ->setEmail($data['email'])
      ->setSenha($data['senha'])
      ->setTelefone($data['telefone'])
      ->setFk_cargo($data['fk_cargo']);
    $funcionarioDAO->insertFuncionario($funcionario);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);
    return $response;
  }

  public function updateFuncionario(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $funcionarioDAO = new FuncionarioDAO();
    $funcionario = new FuncionarioModel();
    $funcionario->setPk_funcionario((int) $data['pk_funcionario'])
      ->setNo_funcionario($data['no_funcionario'])
      ->setNu_cpf($data['nu_cpf'])
      ->setSenha($data['senha'])
      ->setTelefone($data['telefone'])
      ->setFk_cargo($data['fk_cargo']);
    $funcionarioDAO->updateLoja($funcionario);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteFuncionario(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $funcionarioDAO = new FuncionarioDAO;
    $id = (int) $queryParams['id'];
    $funcionarioDAO->deleteFuncionario($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }

  public function getFuncionarioByEmail(Request $request, Response $response, array $args): Response
  {
    $token = $request->getAttribute('jwt');
    $email = $token['email'];
    $funcionarioDAO = new FuncionarioDAO();
    $funcionario = $funcionarioDAO->getFuncionarioByEmail($email);
    echo '<pre>';
    var_dump($funcionario);
    $response = $response->withJson($funcionario);
    return $response;
  }
}