<?php

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultController('PostController');
$routes->setAutoRoute(false);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PostController::index');
$routes->post('/post/add', 'PostController::add');
$routes->get('/post/fetch', 'PostController::fetch');
$routes->get('/post/edit/(:num)', 'PostController::edit/$1');