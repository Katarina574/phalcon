<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('APP_PATH', BASE_PATH . '/config');

$loader = new Loader();

$loader->setDirectories(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
//        APP_PATH . '/config/'
    ]
);

$loader->register();

$container = new FactoryDefault();


//$container->setShared(
//    'voltService',
//    function (ViewBaseInterface $view) use ($container) {
//        $volt = new Volt($view, $container);
//        $volt->setOptions(
//            [
//                'always'    => true,
//                'extension' => '.php',
//                'separator' => '_',
//                'stat'      => true,
//                'path'      => appPath('storage/cache/volt/'),
//                'prefix'    => '-prefix-',
//            ]
//        );
//
//        return $volt;
//    }
//);


$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
//        $view->registerEngines(
//            [
//                '.volt' => 'voltService',
//            ]
//        );
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host'     => 'mysql',
                'port' => 3306,
                'username' => 'katarinakat',
                'password' => 'Sifra123!',
                'dbname'   => 'phalcon_database',
            ]
        );
    }
);
//$container->set(
//    'routes',
//    function () {
//        $router = new \Phalcon\Mvc\Router\Route();
//        $router-
////        $view->registerEngines(
////            [
////                '.volt' => 'voltService',
////            ]
////        );
//        return $view;
//    }
//);
//$container->set('routes', $router);

$application = new Application($container);

try {

    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );
    $response->send();

} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}

