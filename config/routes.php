<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function ($routes) {

    $routes->connect('/', ['controller' => 'Movimentacoes', 'action' => 'index', 'prefix' => 'admin']);
    $routes->connect('/searchUsers', ['controller' => 'Users', 'action' => 'search', 'prefix' => 'admin']);
    $routes->connect('/searchTipos', ['controller' => 'Tipos', 'action' => 'search', 'prefix' => 'admin']);
    $routes->connect('/searchMovimentacoes', ['controller' => 'Movimentacoes', 'action' => 'search', 'prefix' => 'admin']);

    $routes->fallbacks('DashedRoute');
});

Router::prefix('admin', function ($routes){
    $routes->connect('/', ['controller' => 'Users', 'action' => 'index']);    
    $routes->extensions('pdf');
    $routes->connect('/view/*', ['controller' => 'Users', 'action' => 'view']);
    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();
