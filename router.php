<?php

require_once 'libs/router.php';
require_once 'app/controllers/vuelos.controller.php';

$router = new Router(); //Basado en el router dado en clase

$router->addRoute(' ', 'GET', 'vuelosController', 'getVuelos');
$router->addRoute('ciudades', 'GET', 'vuelosController', 'getCiudades');
$router->addRoute('vuelo/:id', 'GET', 'vuelosController', 'getVuelosById');
$router->addRoute('insertarVuelo', 'POST', 'vuelosController', 'insertarVuelo');

if (isset($_GET['resource'])) {
    $resource = $_GET['resource'];
} else {
    $resource = '';
}

$router->route($resource, $_SERVER['REQUEST_METHOD']);