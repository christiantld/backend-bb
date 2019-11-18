<?php

use App\Controllers\AuthController;
use App\Controllers\FornecedorController;
use App\Controllers\UsuarioController;
use App\Controllers\CategoriaController;
use App\Controllers\ProdutoController;
use App\Controllers\LoteController;
use App\Controllers\EntradaController;
use App\Controllers\SaidaController;

use App\Middlewares\JwtDateTimeMiddleware;
use Tuupola\Middleware\JwtAuthentication;

use function src\jwtAuth;
use function src\slimConfiguration;

$app = new \Slim\App(slimConfiguration());

//=================================

$app->post('/login', AuthController::class . ':login');
$app->post('/refresh-token', AuthController::class . ':refreshToken');

// ->add(new JwtDateTimeMiddleware())
// ->add(jwtAuth());



//Rotas Usuarios
$app->get('/usuarios', UsuarioController::class . ':getUsuarios');
$app->post('/registrar', UsuarioController::class . ':insertUsuario');
$app->put('/usuario', UsuarioController::class . ':updateUsuario');
$app->delete('/usuario', UsuarioController::class . ':deleteUsuario');
$app->get('/usuario-e', UsuarioController::class . ':getUsuarioByEmail');
$app->get('/usuario', UsuarioController::class . ':getUsuario');

//Rotas Fornecedor
$app->post('/fornecedor', FornecedorController::class . ':insertFornecedor');
$app->get('/fornecedores', FornecedorController::class . ':getFornecedores');
$app->get('/fornecedor', FornecedorController::class . ':getFornecedor');
$app->put('/fornecedor', FornecedorController::class . ':updateFornecedor');
$app->delete('/fornecedor', FornecedorController::class . ':deleteFornecedor');

//Rotas Categoria
$app->post('/categoria', CategoriaController::class . ':insertCategoria');
$app->get('/categorias', CategoriaController::class . ':getCategorias');
$app->get('/categoria', CategoriaController::class . ':getCategoria');
$app->put('/categoria', CategoriaController::class . ':updateCategoria');
$app->delete('/categoria', CategoriaController::class . ':deleteCategoria');


// //rotas produtos
$app->get('/produtos', ProdutoController::class . ':getProdutos');
$app->get('/produto', ProdutoController::class . ':getProduto');
$app->post('/produto', ProdutoController::class . ':insertProduto');
$app->put('/produto', ProdutoController::class . ':updateProduto');
$app->delete('/produto', ProdutoController::class . ':deleteProduto');

//Rotas Lote
$app->get('/lotes', LoteController::class . ':getLotes');
$app->get('/lote', LoteController::class . ':getLote');
$app->post('/lote', LoteController::class . ':insertLote');
$app->put('/lote', LoteController::class . ':updateLote');
$app->delete('/lote', LoteController::class . ':deleteLote');

//Rotas Entradas
$app->get('/entradas', EntradaController::class . ':getEntradas');
$app->get('/entrada', EntradaController::class . ':getEntrada');
$app->post('/entrada', EntradaController::class . ':insertEntrada');
$app->put('/entrada', EntradaController::class . ':updateEntrada');
$app->delete('/entrada', EntradaController::class . ':deleteEntrada');

//Rotas Saida
$app->get('/saidas', SaidaController::class . ':getSaidas');
$app->get('/saida', SaidaController::class . ':getSaida');
$app->post('/saida', SaidaController::class . ':insertSaida');
$app->put('/saida', SaidaController::class . ':updateSaida');
$app->delete('/saida', SaidaController::class . ':deleteSaida');
//========================================

$app->run();