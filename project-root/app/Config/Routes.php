<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// ================= AUTH =================
$routes->get('login', 'AuthController::loginView');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');


// ================= ADMIN =================
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // Dashboard
    $routes->get('dashboard', 'AdminController::dashboard');

    // ================= PELÍCULAS =================
    $routes->get('peliculas', 'PeliculaController::index');
    $routes->post('peliculas/store', 'PeliculaController::store');
    $routes->post('peliculas/update/(:num)', 'PeliculaController::update/$1');
    $routes->get('peliculas/delete/(:num)', 'PeliculaController::delete/$1');
    $routes->get('peliculas/toggle/(:num)', 'PeliculaController::toggle/$1');

    // ================= CLIENTES =================
    $routes->get('clientes', 'ClienteController::index');
    $routes->post('clientes/store', 'ClienteController::store');
    $routes->post('clientes/update/(:num)', 'ClienteController::update/$1');
    $routes->get('clientes/toggle/(:num)', 'ClienteController::toggle/$1');
    $routes->get('clientes/reset-password/(:num)', 'ClienteController::resetPassword/$1');

});

// ================= API =================
$routes->group('api', function($routes) {
    $routes->get('peliculas', 'API\PeliculaController::index');
    $routes->get('peliculas/(:num)', 'API\PeliculaController::show/$1');
});