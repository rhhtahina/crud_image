<?php

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultController('PostController');
$routes->setAutoRoute(false);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PostController::index');
