<?php

namespace Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View as MvcView;
use Phalcon\Acl\Adapter\Memory as Acl;

defined('APP_PATH') || define('APP_PATH', APPS_PATH . 'backend' . DIRECTORY_SEPARATOR);

class Module
{
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Backend' => APP_PATH . 'controllers' . DIRECTORY_SEPARATOR,
        ]);

        $loader->register();
    }

    public function registerServices($di)
    {
        $di->setShared(
            'acl', function () {
                $acl = new Acl();
                // TODO: add config.
                return $acl;
            }
        );

        // Registering a namespace.
        $di->get('dispatcher')->setDefaultNamespace('Backend\\');

        // Registering the view service.
        $di->setShared(
            'view', 
            function () {
                $view = new MvcView();
                $view->setViewsDir(APP_PATH . 'views' . DIRECTORY_SEPARATOR);
                return $view;
            }
        );
    }
}
