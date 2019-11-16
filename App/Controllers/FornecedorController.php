<?php

namespace App\Controllers;

use App\DAO\FornecedorDAO;
use App\Models\FornecedorModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class FornecedorController
{
  public function getFornecedores(Request $request, Response $response, array $args): Response
  {
    $fornecedorDAO = new FornecedorDAO();
    $fornecedores = $fornecedorDAO->getAllFornecedores();
    $response = $response->withJson($fornecedores);

    return $response;
  }

  public function getFornecedor(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();
    $id = (int) $queryParams['id'];
    $fornecedorDAO = new FornecedorDAO();
    $fornecedor = $fornecedorDAO->getFornecedorById($id);
    $response = $response->withJson($fornecedor);

    return $response;
  }

  public function insertFornecedor(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $fornecedorDAO = new FornecedorDAO();
    $fornecedor = new FornecedorModel();
    $fornecedor
      ->setNo_fornecedor($data['no_fornecedor'])
      ->setEmail($data['email'])
      ->setTelefone($data['telefone']);
    $fornecedorDAO->insertFornecedor($fornecedor);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateFornecedor(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $fornecedorDAO = new FornecedorDAO();
    $fornecedor = new FornecedorModel();
    $fornecedor
      ->setPk_fornecedor((int) $data['pk_fornecedor'])
      ->setNo_fornecedor($data['no_fornecedor'])
      ->setEmail($data['email'])
      ->setTelefone($data['telefone']);
    $fornecedorDAO->updateFornecedor($fornecedor);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteFornecedor(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $fornecedorDAO = new FornecedorDAO();
    $id = (int) $queryParams['id'];
    $fornecedorDAO->deleteFornecedor($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }
}