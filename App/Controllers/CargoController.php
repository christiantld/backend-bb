<?php

namespace App\Controllers;

use App\DAO\CargoDAO;
use App\Models\CargoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CargoController
{
  public function getCargos(Request $request, Response $response, array $args): Response
  {
    $cargoDAO = new CargoDAO();
    $cargos = $cargoDAO->getAllCargos();
    $response = $response->withJson($cargos);
    return $response;
  }
}