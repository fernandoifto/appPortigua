<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function ($routes) {

    $routes->connect('/', ['controller' => 'Movimentacoes', 'action' => 'add', 'prefix' => 'admin']);
    $routes->fallbacks('DashedRoute');
});

Router::prefix('admin', function ($routes){   
    $routes->extensions('pdf');
    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();
