<?php

namespace App\Controllers;

use App\DAO\LoteDAO;
use App\Models\LoteModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class LoteController
{
  public function getLotes(Request $request, Response $response, array $args): Response
  {
    $loteDAO = new LoteDAO();
    $lotes = $loteDAO->getAllLotes();
    $response = $response->withJson($lotes);

    return $response;
  }

  public function getLote(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();
    $id = (int) $queryParams['id'];
    $loteDAO = new LoteDAO();
    $lote = $loteDAO->getLoteById($id);
    $response = $response->withJson($lote);

    return $response;
  }

  public function insertLote(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $loteDAO = new LoteDAO();
    $lote = new LoteModel();
    $lote
      ->setData_fabricacao($data['data_fabricacao'])
      ->setLote($data['lote'])
      ->setFk_produto($data['fk_produto'])
      ->setData_validade($data['data_validade']);
    $loteDAO->insertLote($lote);
    $response = $response->withJson([
      "message" => "Dados enviados com sucesso"
    ]);

    return $response;
  }

  public function updateLote(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();

    $loteDAO = new LoteDAO();
    $lote = new LoteModel();
    $lote
      ->setPk_lote((int) $data['pk_lote'])
      ->setData_fabricacao($data['data_fabricacao'])
      ->setLote($data['lote'])
      ->setData_validade($data['data_validade'])
      ->setFk_produto($data['fk_produto']);
    $loteDAO->updateLote($lote);

    $response = $response->withJson([
      "message" => "Alteracao realizada com sucesso"
    ]);

    return $response;
  }

  public function deleteLote(Request $request, Response $response, array $args): Response
  {
    $queryParams = $request->getQueryParams();

    $loteDAO = new LoteDAO();
    $id = (int) $queryParams['id'];
    $loteDAO->deleteLote($id);

    $response = $response->withJson([
      'message' => 'Exclusao realizada com sucesso'
    ]);

    return $response;
  }
}