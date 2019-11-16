<?php

namespace App\Controllers;

use App\DAO\LoteDAO;
use App\Models\LoteModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class LoteController
{ }
$app->post('/categoria', CategoriaController::class . ':insertCategoria');
$app->get('/categorias', CategoriaController::class . ':getCategorias');
$app->put('/categoria', CategoriaController::class . ':updateCategoria');
$app->delete('/categoria', CategoriaController::class . ':deleteCategoria');