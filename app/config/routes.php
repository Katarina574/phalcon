<?php
//namespace Katarina\Phalcon\controllers;
use Phalcon\Mvc\Router;


$router = new Router(false);

$router->add(
    '/public',
    [
        'controller' => 'public',
        'action'     => 'index',
    ]
);

//$router->addDelete("/delete", "Delete::delete");
//dokumentacija iznad groups pogledaj za rute
//$router->add(
//    '/edit/{id}',
//    [
////        'namespace'  => 'Katarina\Phalcon\controllers',
//        'controller' => 'edit',
//        'action'     => 'edit',
//    ]
//);
//$router->convert(
//    'id',
//    function ($id) {
//        return Users::findFirstById($id);
//    }
//);

$router->addDelete(
    '/delete/{id}',
    [
//        'namespace'  => 'Katarina\Phalcon\controllers',
        'controller' => 'delete',
        'action'     => 'delete',
    ]
);


$router->handle(
    $_SERVER["REQUEST_URI"]
);
