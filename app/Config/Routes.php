<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#$routes->get('/', 'Home::index');

use App\Controllers\Pages;

$routes->get('/', 'AuthLogin::index', ['filter' => 'guestFilter']);
$routes->post('/', 'AuthLogin::login', ['filter' => 'guestFilter']);
$routes->get('cadastro/', 'AuthCadastro::index', ['filter' => 'guestFilter']);
$routes->post('cadastro/', 'AuthCadastro::cadastro', ['filter' => 'guestFilter']);

$routes->get('aluno/inicio/', 'AlunoController::index', ['filter' => 'authAlunoFilter']);
$routes->get('aluno/reservar/', 'AlunoController::reserva', ['filter' => 'authAlunoFilter']);
$routes->post('aluno/reservar/', 'AlunoController::reservar', ['filter' => 'authAlunoFilter']);
$routes->get('aluno/pagamento/', 'AlunoController::pagamento', ['filter' => 'authAlunoFilter']);
$routes->get('aluno/cardapio/', 'AlunoController::cardapio', ['filter' => 'authAlunoFilter']);
$routes->get('aluno/historico/', 'AlunoController::historico', ['filter' => 'authAlunoFilter']);

$routes->get('cantina/inicio/', 'CantinaController::index', ['filter' => 'authCantinaFilter']);
$routes->get('cantina/cardapio/', 'AlunoController::cardapio', ['filter' => 'authCantinaFilter']);
$routes->get('cantina/cadastros/', 'CantinaController::cadastros', ['filter' => 'authCantinaFilter']);
$routes->get('cantina/reservas/', 'CantinaController::reservas', ['filter' => 'authCantinaFilter']);
$routes->get('cantina/pagamentos/', 'CantinaController::pagamentos', ['filter' => 'authCantinaFilter']);


$routes->get('sair/', 'AuthLogin::logout', ['filter' => 'authFilter']);
