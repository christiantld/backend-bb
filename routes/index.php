<?php

use App\Controllers\AuthController;
use App\Controllers\FornecedorController;
use App\Controllers\FuncionarioController;
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



//Rotas Funcionarios
$app->get('/funcionarios', FuncionarioController::class . ':getFuncionarios');
$app->post('/registrar', FuncionarioController::class . ':insertFuncionario');
$app->put('/funcionario', FuncionarioController::class . ':updateFuncionario');
$app->delete('/funcionario', FuncionarioController::class . ':deleteFuncionario');
$app->get('/funcionario', FuncionarioController::class . ':getFuncionarioByEmail')
  ->add(new JwtDateTimeMiddleware())
  ->add(jwtAuth());

//Rotas Fornecedor
$app->post('/fornecedor', FornecedorController::class . ':insertFornecedor');
$app->get('/fornecedores', FornecedorController::class . ':getFornecedores');
$app->put('/fornecedor', FornecedorController::class . ':updateFornecedor');
$app->delete('/fornecedor', FornecedorController::class . ':deleteFornecedor');



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