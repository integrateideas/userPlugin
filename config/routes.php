<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::plugin(
    'Integrateideas/User',
    ['path' => '/integrateideas/user'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);
// Router::plugin(
//     'Integrateideas/User',
//     ['path' => '/integrateideas/user/users/api/updatePassword/:id'],
//     function (RouteBuilder $routes) {
//         $routes->fallbacks(DashedRoute::class);
//     }
// );

// Router::prefix('api', function ($routes) {

//   $routes->connect('/:controller',array('controller'=>':controller', 'action'=>'add',"_method" => "POST"));

//   $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'edit'),
//   array('pass' => array('id'), 'id'=>'[\d]+',"_method" => "PUT"));

//   $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'view'),
//   array('pass' => array('id'), 'id'=>'[\d]+',"_method" => "GET"));
//   $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'delete'),
//   array('pass' => array('id'), 'id'=>'[\d]+',"_method" => "DELETE"));

//   $routes->connect('/users/updatePassword/:id',array('controller'=>'Users', 'action'=>'updatePassword',"_method" => "PUT"), array('pass' => array('id'), 'id'=>'[\d]+'));
//   // pr('in routes'); die();
//   $routes->fallbacks('InflectedRoute');
// });
