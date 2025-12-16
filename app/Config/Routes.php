<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tables', 'Home::index');
$routes->get('unidades', 'Unidades::index');
$routes->get('nuevo', 'Unidades::index');


