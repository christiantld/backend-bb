<?php

namespace App\Controllers;

use App\DAO\ProdutoDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class  ProdutoController
{
  public function getCategorias(Request $request, Response $response, array $args): Response
  {
    $categoriaDAO = new CategoriaDAO();
    $categorias = $categoriaDAO->getAllCategorias();
    $response = $response->withJson($categorias);
    return $response;
  }

  public function getCategoria(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $categoriaDAO = new CategoriaDAO();
    $categoria = $categoriaDAO->getCategoriaById($data['pk_categoria']);
    $response = $response->withJason($categoria);

    return $response;
  }

  public function insertCategoria(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $categoriaDAO = new CategoriaDAO();
    $categoria = new CategoriaModel();
    $categoria
      ->setNo_categoria($data['no_categoria']);
    $categoriaDAO->insertCategoria($categoria);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateCategoria(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $categoriaDAO = new CategoriaDAO();
    $categoria = new CategoriaModel();
    $categoria
      ->setPk_categoria((int) $data['pk_categoria'])
      ->setNo_categoria($data['no_categoria']);
    $categoriaDAO->updateCategoria($categoria);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);
    return $response;
  }

  public function deleteCategoria(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $categoriaDAO = new CategoriaDAO();
    $id = (int) $queryParams['id'];
    $categoriaDAO->deleteCategoria($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);
    return $response;
  }
};