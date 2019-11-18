<?php

namespace App\Controllers;

use App\DAO\ProdutoDAO;
use App\Models\ProdutoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class  ProdutoController
{
  public function getProdutos(Request $request, Response $response, array $args): Response
  {
    $produtoDAO = new ProdutoDAO();
    $produtos = $produtoDAO->getAllProdutos();
    $response = $response->withJson($produtos);
    return $response;
  }

  public function getProduto(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();
    $id = (int) $queryParams['id'];
    $produtoDAO = new ProdutoDAO();
    $produto = $produtoDAO->getProdutoById($id);
    $response = $response->withJson($produto);

    return $response;
  }

  public function insertProduto(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $produtoDAO = new ProdutoDAO();
    $produto = new ProdutoModel();
    $produto
      ->setNo_produto($data['no_produto'])
      ->setMarca($data['marca'])
      ->setDescricao($data['descricao'])
      ->setQtd_minima($data['qtd_minima'])
      ->setQtd_max($data['qtd_max'])
      ->setQtd_total($data['qtd_total'])
      ->setFk_categoria($data['fk_categoria']);
    $produtoDAO->insertProduto($produto);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateProduto(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $produtoDAO = new ProdutoDAO();
    $produto = new ProdutoModel();
    $produto
      ->setPk_produto((int) $data['pk_produto'])
      ->setNo_produto($data['no_produto'])
      ->setMarca($data['marca'])
      ->setDescricao($data['descricao'])
      ->setQtd_minima($data['qtd_minima'])
      ->setQtd_max($data['qtd_max'])
      ->setQtd_total($data['qtd_total'])
      ->setFk_categoria($data['fk_categoria']);
    $produtoDAO->updateProduto($produto);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);
    return $response;
  }

  public function deleteProduto(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $produtoDAO = new ProdutoDAO();
    $id = (int) $queryParams['id'];
    $produtoDAO->deleteProduto($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);
    return $response;
  }
};