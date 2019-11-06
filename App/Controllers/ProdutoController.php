<?php

namespace App\Controllers;

use App\DAO\LojasDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class  ProdutoController
{
  public function getProdutos(Request $request, Response $response, array $args): Response
  {
    $response = $response->withJson([
      "message" => "Hello Get"
    ]);
    return $response;
  }

  public function insertProduto(Request $request, Response $response, array $args): Response
  {
    $response = $response->withJson([
      "message" => "Hello Post"
    ]);
    return $response;
  }

  public function updateProduto(Request $request, Response $response, array $args): Response
  {
    $response = $response->withJson([
      "message" => "Hello Put"
    ]);
    return $response;
  }

  public function deleteProduto(Request $request, Response $response, array $args): Response
  {
    $response = $response->withJson([
      "message" => "Hello Delete"
    ]);
    return $response;
  }
};