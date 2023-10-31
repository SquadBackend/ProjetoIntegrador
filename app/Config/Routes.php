<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#$routes->get('/', 'Home::index');

use App\Controllers\Pages;

$routes->group("api", function ($routes) {
    $routes->resource('usuarios', ['controller' => 'Api\usuarios', 'filter' => 'authApiFilter', 'websafe' => 1]);
    $routes->resource('pedidos', ['controller' => 'Api\pedidos', 'filter' => 'authApiFilter', 'websafe' => 1]);
    $routes->post('payAll/(:num)', 'Api\pedidos::payAll/$1', ['filter' => 'authApiFilter']);
});

$routes->get('/', 'AuthLogin::index', ['filter' => 'guestFilter']);
$routes->post('/', 'AuthLogin::login', ['filter' => 'guestFilter']);
$routes->get('cadastro/', 'AuthCadastro::index', ['filter' => 'guestFilter']);
$routes->post('cadastro/', 'AuthCadastro::cadastro', ['filter' => 'guestFilter']);

$routes->get('aluno/', 'AlunoController::index', ['filter' => 'authUserFilter']);
$routes->get('aluno/reservar/', 'AlunoController::reserva', ['filter' => 'authUserFilter']);
$routes->post('aluno/reservar/', 'AlunoController::reservar', ['filter' => 'authUserFilter']);
$routes->get('aluno/pagamento/', 'AlunoController::pagamento', ['filter' => 'authUserFilter']);
$routes->get('aluno/cardapio/', 'AlunoController::cardapio', ['filter' => 'authUserFilter']);
$routes->get('aluno/historico/', 'AlunoController::historico', ['filter' => 'authUserFilter']);

$routes->get('cantina/', 'CantinaController::index', ['filter' => 'authUserFilter']);
$routes->get('cantina/cardapio/', 'CantinaController::cardapio', ['filter' => 'authUserFilter']);
$routes->get('cantina/cadastros/', 'CantinaController::cadastros', ['filter' => 'authUserFilter']);
$routes->get('cantina/reservas/', 'CantinaController::reservas', ['filter' => 'authUserFilter']);
$routes->get('cantina/historico/', 'CantinaController::historico', ['filter' => 'authUserFilter']);
$routes->get('cantina/pagamentos/', 'CantinaController::pagamentos', ['filter' => 'authUserFilter']);

$routes->get('cae/', 'CaeController::index', ['filter' => 'authUserFilter']);
$routes->get('cae/cadastros', 'CaeController::cadastros', ['filter' => 'authUserFilter']);
$routes->get('cae/reservas', 'CaeController::reservas', ['filter' => 'authUserFilter']);
$routes->get('cae/historico', 'CaeController::historico', ['filter' => 'authUserFilter']);

$routes->get('sair/', 'AuthLogin::logout', ['filter' => 'authFilter']);
