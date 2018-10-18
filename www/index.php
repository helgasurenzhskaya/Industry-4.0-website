<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault as Di;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as Url;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Application;
use Phalcon\Http\Response\Cookies;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

// Define some absolute path constants to aid in locating resources.
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APPS_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);

$loader = new Loader();

$loader->registerDirs(
    [
        APPS_PATH . 'models' . DIRECTORY_SEPARATOR,
        APPS_PATH . 'services' . DIRECTORY_SEPARATOR,
    ]
);

$loader->register();

// Create a DI.
$di = new Di();

// Setup a base URI.
$di->setShared(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('http://' . $_SERVER['SERVER_NAME'] . '/');
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
    $lang = $di->get('lang');

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

    $frontend = new RouterGroup(['module' => 'frontend',]);
    $backend = new RouterGroup(['module' => 'backend',]);
    
    $router->add('/{language:(' . $_langs . ')}')->setName('home');

    $frontend->add('/', [
        'controller' => 'index',
        'action' => 'index',
    ]);

    $frontend->add('/{language:(' . $_langs . ')}/article/{article_id}', [
        'controller' => 'article',
        'action' => 'show',
        'lang' => '',
    ])->setName('article/show');

    $frontend->add('/sitemap.xml', [
        'controller' => 'index',
        'action' => 'sitemap',
    ]);

    $frontend->add('/robots.txt', [
        'controller' => 'index',
        'action' => 'robots',
    ]);

    $router->mount($frontend);
    //$router->mount($backend);
    $router->setDefaultModule('frontend');
   
    $router->notFound(['module' => 'frontend', 'controller' => 'error', 'action' => 'show404']);

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

$di->setShared(
    'translate',
    function () use ($di) {
        $lang = $di->get('lang');
        $dispatcher = $di->get('dispatcher');
        $file = APPS_PATH . $dispatcher->getModuleName() . DIRECTORY_SEPARATOR . 'messages' . DIRECTORY_SEPARATOR . $lang->getCurrent()->getId() . '.php';
        $translate = new \Phalcon\Translate\Adapter\NativeArray([
            'content' => require_once $file,
        ]);

        return $translate;
    }
);


$application = new Application($di);
$application->registerModules([
    'frontend' => [
        'className' => 'Frontend\Module',
        'path' => APPS_PATH . 'frontend' . DIRECTORY_SEPARATOR . 'Module.php',
    ],
    'backend' => [
        'className' => 'Backend\Module',
        'path' => APPS_PATH . 'backend' . DIRECTORY_SEPARATOR . 'Module.php',
    ],
]);
// try {
    $response = $application->handle();
// } catch (Exception $e) {
//     $response = $application->handle('error/show500');
// }
$response->send();
