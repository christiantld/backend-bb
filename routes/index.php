<?php

use App\Controllers\AuthController;
use App\Controllers\FornecedorController;
use App\Controllers\UsuarioController;
use App\Controllers\ProdutoController;
use App\Controllers\LojaController;
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
$app->get('/usuario', UsuarioController::class . ':getUsuarioByEmail');

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


// //rotas lojas
// $app->get('/loja', LojaController::class . ':getLojas');
// $app->post('/loja', LojaController::class . ':insertLoja');
// $app->put('/loja', LojaController::class . ':updateLoja');
// $app->delete('/loja', LojaController::class . ':deleteLoja');

// //rotas produtos
// $app->get('/produto', ProdutoController::class . ':getProdutos');
// $app->post('/produto', ProdutoController::class . ':insertProduto');
// $app->put('/produto', ProdutoController::class . ':updateProduto');
// $app->delete('/produto', ProdutoController::class . ':deleteProduto');

//========================================

$app->run();