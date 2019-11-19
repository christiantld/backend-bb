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
    $qtd_item = 0;
    if ($data['qtd_item'] <= 0)
      $entrada->setQtd_item(0);

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->addProduto($produto, $entrada, $qtd_item);

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
      ->setPk_entrada((int) $data['pk_entrada'])
      ->setData_entrada($data['data_entrada'])
      ->setQtd_item($data['qtd_item'])
      ->setValor_item($data['valor_item'])
      ->setFk_produto($data['fk_produto'])
      ->setFk_usuario($data['fk_usuario'])
      ->setFk_fornecedor($data['fk_fornecedor']);
    if ($data['qtd_item'] <= 0)
      $entrada->setQtd_item(0);

    $qtd_item = $entradaDAO->getEntradabyId((int) $data['pk_entrada']);
    if ($qtd_item === 0)
      $qtd_item = 0;
    $qtd_item = $qtd_item[0]['qtd_item'];

    $entradaDAO->updateEntrada($entrada);

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->addProduto($produto, $entrada, $qtd_item);

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