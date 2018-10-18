<?php

namespace Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View as MvcView;

defined('APP_PATH') || define('APP_PATH', APPS_PATH . 'frontend' . DIRECTORY_SEPARATOR);

class Module
{
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Frontend' => APP_PATH . 'controllers' . DIRECTORY_SEPARATOR,
        ]);

        $loader->register();
    }

    public function registerServices($di)
    {
        // Registering a namespace.
        $di->get('dispatcher')->setDefaultNamespace('Frontend\\');

        // Registering the view service.
        $di->set('view', function () {
            $view = new MvcView();
            $view->setViewsDir(APP_PATH . 'views' . DIRECTORY_SEPARATOR);
            return $view;
        });
    }
}
