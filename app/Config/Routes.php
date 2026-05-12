<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', fn() => redirect()->to('/login'));

// LOGIN
$routes->get('/login', 'AuthController::login');
$routes->post('/login/auth', 'AuthController::auth');

// CADASTRO
$routes->get('/register', 'AuthController::register');
$routes->post('/register/store', 'AuthController::store');

// LOGOUT
$routes->get('/logout', 'AuthController::logout');

// ROTAS PROTEGIDAS
$routes->group('', ['filter' => 'auth'], function($routes) {

    $routes->get('/dashboard', 'PostController::index');
    $routes->get('/feed', 'PostController::index');

    $routes->post('/postar', 'PostController::create');

    $routes->get('/perfil', 'UserController::meuPerfil');

    $routes->get('/perfil/(:num)', 'UserController::perfil/$1');

    $routes->get('/post/create', 'PostController::create');

    $routes->get('/post/edit/(:num)', 'PostController::edit/$1');

    $routes->post('/post/update/(:num)', 'PostController::update/$1');

    $routes->get('/post/delete/(:num)', 'PostController::delete/$1');

    $routes->get('/post/like/(:num)', 'PostController::like/$1');

    $routes->get('/post/dislike/(:num)', 'PostController::dislike/$1');

    $routes->post('/post/comentar/(:num)', 'PostController::comentar/$1');

    $routes->get('/follow/(:num)', 'UserController::follow/$1');
});