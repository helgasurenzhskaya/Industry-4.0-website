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
define('CONTENT_PATH', BASE_PATH . 'www' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR);

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

    $backend->add('/admin/login', [
        'controller' => 'auth',
        'action' => 'login',
    ])->setName('backend/login');

    $backend->add('/admin/logout', [
        'controller' => 'auth',
        'action' => 'logout',
    ])->setName('backend/logout');

    $backend->add('/admin', [
        'controller' => 'index',
        'action' => 'index',
    ])->setName('backend');

    $backend->add('/admin/page/list', [
        'controller' => 'page',
        'action' => 'list',
    ])->setName('backend/page/list');

    $backend->add('/admin/page/add', [
        'controller' => 'page',
        'action' => 'add',
    ])->setName('backend/page/add');

    $backend->add('/admin/page/{action:(edit|delete)}/{page_id}', [
        'controller' => 'page',
    ])->setName('backend/page/item_action');

    $backend->add('/admin/account/list', [
        'controller' => 'user',
        'action' => 'list',
    ])->setName('backend/user/list');

    $backend->add('/admin/account/add', [
        'controller' => 'user',
        'action' => 'add',
    ])->setName('backend/user/add');

    $backend->add('/admin/account/{action:(edit|delete)}/{user_id}', [
        'controller' => 'user',
    ])->setName('backend/user/item_action');

    $backend->add('/admin/navigation/list', [
        'controller' => 'navigation',
        'action' => 'list',
    ])->setName('backend/navigation/list');

    $backend->add('/admin/navigation/add', [
        'controller' => 'navigation',
        'action' => 'add',
    ])->setName('backend/navigation/add');

    $backend->add('/admin/navigation/{action:(edit|delete)}/{navigation_id}', [
        'controller' => 'navigation',
    ])->setName('backend/navigation/item_action');

    $backend->add('/admin/article/list', [
        'controller' => 'article',
        'action' => 'list',
    ])->setName('backend/article/list');

    $backend->add('/admin/article/add', [
        'controller' => 'article',
        'action' => 'add',
    ])->setName('backend/article/add');

    $backend->add('/admin/article/{action:(edit|delete)}/{article_id}', [
        'controller' => 'article',
    ])->setName('backend/article/item_action');


    $router->mount($frontend);
    $router->mount($backend);
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
        $translate = new Phalcon\Translate\Adapter\NativeArray([
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
