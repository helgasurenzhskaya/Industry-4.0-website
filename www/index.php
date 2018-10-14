<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault as Di;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as Url;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Application;
use Phalcon\Http\Response\Cookies;
use Phalcon\Mvc\Router;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . 'controllers' . DIRECTORY_SEPARATOR,
        APP_PATH . 'models' . DIRECTORY_SEPARATOR,
        APP_PATH . 'services' . DIRECTORY_SEPARATOR,
    ]
);

$loader->register();

// Create a DI
$di = new Di();

// Setup the view component
$di->setShared(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . 'views' . DIRECTORY_SEPARATOR);
        return $view;
    }
);

// Setup a base URI
$di->setShared(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$di->setShared(
    'db',
    function () {
        $db = new DbAdapter(
            [
                'host' => 'yankos0.mysql.tools',
                'username' => 'yankos0_db',
                'password' => '2rCX5Fku',
                'dbname' => 'yankos0_db',
                'charset' => 'utf8',
                'options' => [
                    PDO::ATTR_PERSISTENT => 1,
                ],
            ]
        );
        return $db;
    }
);

$di->setShared('router', function () use ($di) {
    /** @var Language $lang */
    $lang = $di->get('lang');

    /** @var string $_langs строчка языков */
    $_langs = implode(
        '|', 
        array_map(
            function (lang $item): string {
                return $item->getId();
            }, 
            $lang->getAll()
        )
    );

    $router = new Router(false);
    $router->removeExtraSlashes(true);
    
    $router->add('/{language:(' . $_langs . ')}')->setName('home');

    $router->add('/', [
        'controller' => 'index',
        'action' => 'index',
    ]);

    $router->add('/{language:(' . $_langs . ')}/article/{article}', [
        'controller' => 'article',
        'action' => 'show',
        'lang' => '',
    ])->setName('article/show');

    $router->add('/{language:(' . $_langs . ')}/article', [
        'controller' => 'article',
        'action' => 'list',
        'lang' => '',
    ])->setName('article/list');

    $router->add('/sitemap.xml', [
        'controller' => 'index',
        'action' => 'sitemap',
    ]);

    $router->add('/robots.txt', [
        'controller' => 'index',
        'action' => 'robots',
    ]);
    
    $router->notFound(['controller' => 'error', 'action' => 'show404']);

    return $router;
});

$di->setShared('cookies', function () {
    $cookies = new Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});

$di->setShared(
    'lang',
    function () {
        return new LangService(
            [
                'default' => 'uk',
                'langs' => [
                    [
                        'code' => 'uk',
                        'title' => 'Українська',
                    ],
                    [
                        'code' => 'en',
                        'title' => 'English',
                    ],
                ],
            ]
        );
    }
);

$application = new Application($di);
// try {
    $response = $application->handle();
// } catch (Exception $e) {
//     $response = $application->handle('error/show500');
// }
$response->send();
