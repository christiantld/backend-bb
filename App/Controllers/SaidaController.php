<?php

namespace App\Controllers;

use App\DAO\SaidaDAO;
use App\DAO\ProdutoDAO;
use App\Models\SaidaModel;
use App\Models\ProdutoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class SaidaController
{
  public function getSaidas(Request $request, Response $response, array $args): Response
  {
    $saidaDAO = new SaidaDAO();
    $saidas = $saidaDAO->getAllSaidas();
    $response = $response->withJson($saidas);

    return $response;
  }

  public function getSaida(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();
    $id = (int) $queryParams['id'];
    $saidaDAO = new SaidaDAO();
    $saida = $saidaDAO->getSaidaById($id);
    $response = $response->withJson($saida);

    return $response;
  }

  public function insertSaida(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $saidaDAO = new SaidaDAO();
    $saida = new SaidaModel();
    $saida
      ->setqtd_item($data['qtd_item'])
      ->setdata_saida($data['data_saida'])
      ->setfk_usuario($data['fk_usuario'])
      ->setfk_produto($data['fk_produto']);
    if ($data['qtd_item'] <= 0)
      $saida->setQtd_item(0);
    $saidaDAO->insertSaida($saida);
    $qtd_item = 0;

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->removeProduto($produto, $saida, $qtd_item);

    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateSaida(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $saidaDAO = new SaidaDAO();
    $saida = new SaidaModel();
    $saida
      ->setPk_saida((int) $data['pk_saida'])
      ->setData_saida($data['data_saida'])
      ->setQtd_item($data['qtd_item'])
      ->setFk_produto($data['fk_produto'])
      ->setFk_usuario($data['fk_usuario']);
    if ($data['qtd_item'] <= 0)
      $saida->setQtd_item(0);

    $qtd_item = $saidaDAO->getSaidabyId((int) $data['pk_saida']);
    if ($qtd_item <= 0)
      $qtd_item = 0;
    $qtd_item = $qtd_item[0]['qtd_item'];

    if ($data['qtd_item'] <= 0)
      $saida->setQtd_item(0);

    $saidaDAO->updateSaida($saida);

    $id = (int) $data['fk_produto'];
    $produtoDAO = new ProdutoDAO;
    $produtoData = $produtoDAO->getProdutoById($id);

    $produto = new ProdutoModel();
    $produto->setQtd_total($produtoData[0]['qtd_total']);

    $produtoDAO->removeProduto($produto, $saida, $qtd_item);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteSaida(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $saidaDAO = new SaidaDAO();
    $id = (int) $queryParams['id'];
    $saidaDAO->deleteSaida($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }
}