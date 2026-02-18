<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Rutas para autenticación
$routes->get('login', 'AuthController::loginView');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');

    $routes->get('peliculas', 'PeliculaController::index');
    $routes->get('peliculas/create', 'PeliculaController::create');
    $routes->post('peliculas/store', 'PeliculaController::store');
    $routes->get('peliculas/edit/(:num)', 'PeliculaController::edit/$1');
    $routes->post('peliculas/update/(:num)', 'PeliculaController::update/$1');
    $routes->get('peliculas/delete/(:num)', 'PeliculaController::delete/$1');
});