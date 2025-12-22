<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('usuarios');
$routes->setDefaultMethod('index');
$routes->get('/', 'Usuarios::login');
$routes->get('login', 'Usuarios::login');
$routes->post('login', 'Usuarios::valida');
$routes->get('tables', 'Usuarios::tables');
$routes->get('tables', 'Home::index');
$routes->get('unidades', 'Unidades::index');
$routes->get('unidades/nuevo', 'Unidades::nuevo');
$routes->post('unidades/insertar', 'Unidades::insertar');
$routes->post('unidades/actualizar', 'Unidades::actualizar');
$routes->get('unidades/editar/(:num)', 'Unidades::editar/$1');
$routes->get('unidades/eliminar/(:num)', 'Unidades::eliminar/$1');
$routes->get('unidades/eliminados', 'Unidades::eliminados');
$routes->get('unidades/reingresar/(:num)', 'Unidades::reingresar/$1');

$routes->get('categorias', 'Categorias::index');
$routes->get('categorias/nuevo', 'Categorias::nuevo');
$routes->post('categorias/insertar', 'Categorias::insertar');
$routes->post('categorias/actualizar', 'Categorias::actualizar');
$routes->get('categorias/editar/(:num)', 'Categorias::editar/$1');
$routes->get('categorias/eliminar/(:num)', 'Categorias::eliminar/$1');
$routes->get('categorias/eliminados', 'Categorias::eliminados');
$routes->get('categorias/reingresar/(:num)', 'Categorias::reingresar/$1');

$routes->get('productos', 'Productos::index');
$routes->get('productos/nuevo', 'Productos::nuevo');
$routes->post('productos/insertar', 'Productos::insertar');
$routes->post('productos/actualizar', 'Productos::actualizar');
$routes->get('productos/editar/(:num)', 'Productos::editar/$1');
$routes->get('productos/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->get('productos/eliminados', 'Productos::eliminados');
$routes->get('productos/reingresar/(:num)', 'Productos::reingresar/$1');
$routes->get('productos/buscarPorCodigo(:any)', 'Productos::buscarPorCodigo/$1');

$routes->get('clientes', 'Clientes::index');
$routes->get('clientes/nuevo', 'Clientes::nuevo');
$routes->post('clientes/insertar', 'Clientes::insertar');
$routes->post('clientes/actualizar', 'Clientes::actualizar');
$routes->get('clientes/editar/(:num)', 'Clientes::editar/$1');
$routes->get('clientes/eliminar/(:num)', 'Clientes::eliminar/$1');
$routes->get('clientes/eliminados', 'Clientes::eliminados');
$routes->get('clientes/reingresar/(:num)', 'Clientes::reingresar/$1');

$routes->get('configuracion', 'Configuracion::index');
$routes->get('configuracion/configuracion', 'Configuracion::index');
$routes->post('configuracion/insertar', 'Configuracion::insertar');
$routes->post('configuracion/actualizar', 'Configuracion::actualizar');
$routes->get('configuracion/editar/(:num)', 'Configuracion::editar/$1');
$routes->get('configuracion/eliminar/(:num)', 'Configuracion::eliminar/$1');
$routes->get('configuracion/eliminados', 'Configuracion::eliminados');
$routes->get('configuracion/reingresar/(:num)', 'Configuracion::reingresar/$1');
$routes->get('logout', 'Usuarios::logout');
$routes->post('configuracion/actualizar', 'Configuracion::actualizar');
$routes->get('configuracion', 'Configuracion::index');

$routes->get('usuarios', 'Usuarios::index');
$routes->get('usuarios/nuevo', 'Usuarios::nuevo');
$routes->post('usuarios/insertar', 'Usuarios::insertar');
$routes->post('usuarios/actualizar', 'Usuarios::actualizar');
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
$routes->get('usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1');
$routes->get('usuarios/eliminados', 'Usuarios::eliminados');
$routes->get('usuarios/reingresar/(:num)', 'Usuarios::reingresar/$1');
$routes->get('perfil', 'Usuarios::perfil');
$routes->post('usuarios/cambia_password', 'Usuarios::cambia_password');
$routes->get('cambia_password', 'Usuarios::cambia_password');
$routes->post('usuarios/actualizar_password', 'Usuarios::actualizar_password');

$routes->get('compras', 'Compras::index');
$routes->get('compras/nuevo', 'Compras::nuevo');
$routes->post('compras/guarda', 'Compras::guarda');
$routes->post('compras/guardarCompra', 'Compras::guardarCompra');
$routes->get('compras/eliminar/(:num)', 'Compras::eliminar/$1');
$routes->get('compras/detalle/(:num)', 'Compras::detalle/$1');
$routes->get('TemporalCompra/inserta/(:num)/(:num)/(:alphanum)', 'TemporalCompra::inserta/$1/$2/$3');
$routes->get('TemporalCompra/cargaProductos/(:alphanum)', 'TemporalCompra::cargaProductos/$1');
$routes->get('TemporalCompra/eliminar/(:num)/(:alphanum)', 'TemporalCompra::eliminar/$1/$2');
$routes->get('TemporalCompra/eliminaProducto/(:num)/(:alphanum)', 'TemporalCompra::eliminaProducto/$1/$2');





