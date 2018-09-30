<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault as Di;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as Url;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Application;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . 'controllers' . DIRECTORY_SEPARATOR,
        APP_PATH . 'models' . DIRECTORY_SEPARATOR,
    ]
);

$loader->register();

// Create a DI
$di = new Di();

// Setup the view component
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . 'views' . DIRECTORY_SEPARATOR);
        return $view;
    }
);

// Setup a base URI
$di->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$di->set(
    'db',
    function () {
        $db = new DbAdapter(
            [
                'host' => 'yankos0.mysql.tools',
                'username' => 'yankos0_db',
                'password' => '2rCX5Fku',
                'dbname' => 'yankos0_db',
            ]
        );
        return $db;
    }
);

$application = new Application($di);
$response = $application->handle();
$response->send();
