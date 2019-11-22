<?php

namespace App\Controllers;

use App\DAO\EntradaDAO;
use App\Models\EntradaModel;
use App\DAO\SaidaDAO;
use App\Models\SaidaModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class HistoricoController
{
  public function getHistorico(Request $request, Response $response, array $args): Response
  {
    $entradaDAO = new EntradaDAO();
    $entradas = $entradaDAO->getAllEntradas();
    $saidaDAO = new SaidaDAO();
    $saidas = $saidaDAO->getAllSaidas();
    $historico = [$entradas, $saidas];
    $response = $response->withJson(
      $historico
    );
    return $response;
  }
}