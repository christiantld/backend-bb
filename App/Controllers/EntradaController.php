<?php

namespace App\Controllers;

use App\DAO\EntradaDAO;
use App\DAO\ProdutoDAO;
use App\Models\EntradaModel;
use App\Models\ProdutoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class EntradaController
{
  public function getEntradas(Request $request, Response $response, array $args): Response
  {
    $entradaDAO = new EntradaDAO();
    $entradas = $entradaDAO->getAllEntradas();
    $response = $response->withJson($entradas);

    return $response;
  }

  public function getEntrada(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();
    $id = (int) $queryParams['id'];
    $entradaDAO = new EntradaDAO();
    $entrada = $entradaDAO->getEntradaById($id);
    $response = $response->withJson($entrada);

    return $response;
  }

  public function insertEntrada(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $entradaDAO = new EntradaDAO();
    $entrada = new EntradaModel();
    $produtoDAO = new ProdutoDAO();
    $produto = new ProdutoModel();


    $entrada
      ->setdata_entrada($data['data_entrada'])
      ->setqtd_item($data['qtd_item'])
      ->setvalor_item($data['valor_item'])
      ->setfk_usuario($data['fk_usuario'])
      ->setfk_fornecedor($data['fk_fornecedor'])
      ->setfk_produto($data['fk_produto']);
    $entradaDAO->insertEntrada($entrada);

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->addProduto($produto, $entrada);

    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateEntrada(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $entradaDAO = new EntradaDAO();
    $entrada = new EntradaModel();
    $entrada
      ->setpk_entrada((int) $data['pk_entrada'])
      ->setdata_entrada($data['data_entrada'])
      ->setqtd_item($data['qtd_item'])
      ->setvalor_item($data['valor_item'])
      ->setfk_produto($data['fk_produto'])
      ->setfk_usuario($data['fk_usuario'])
      ->setfk_fornecedor($data['fk_fornecedor']);
    $entradaDAO->updateEntrada($entrada);

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->addProduto($produto, $entrada);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteEntrada(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $entradaDAO = new EntradaDAO();
    $id = (int) $queryParams['id'];
    $entradaDAO->deleteEntrada($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }
}