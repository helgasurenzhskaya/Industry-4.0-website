<?php

namespace Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View as MvcView;
use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclAdapter;
use Phalcon\Acl\Role as AclRole;
use Phalcon\Acl\Resource as AclResource;

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
                $acl = new AclAdapter();

                $acl->setDefaultAction(Acl::DENY);

                $acl->addRole(new AclRole('admin'));
                $acl->addRole(new AclRole('editor'));

                /**
                 * [
                 *     'controller name ...' => [
                 *         'action name ...' => [
                 *             'allowed role ...',
                 *         ],
                 *     ],
                 * ]
                 */
                $config = [
                    'index' => [
                        'index' => [
                            'admin',
                            'editor',
                        ],
                    ],
                    'user' => [
                        'add' => [
                            'admin',
                        ],
                        'delete' => [
                            'admin',
                        ],
                        'edit' => [
                            'admin',
                        ],
                        'list' => [
                            'admin',
                        ],
                    ],
                    'page' => [
                        'add' => [
                            'admin',
                        ],
                        'delete' => [
                            'admin',
                        ],
                        'edit' => [
                            'admin',
                            'editor',
                        ],
                        'list' => [
                            'admin',
                            'editor',
                        ],
                    ],
                    'article' => [
                        'add' => [
                            'admin',
                        ],
                        'delete' => [
                            'admin',
                        ],
                        'edit' => [
                            'admin',
                            'editor',
                        ],
                        'list' => [
                            'admin',
                            'editor',
                        ],
                    ],
                    'menu' => [
                        'add' => [
                            'admin',
                        ],
                        'delete' => [
                            'admin',
                        ],
                        'edit' => [
                            'admin',
                        ],
                        'list' => [
                            'admin',
                        ],
                    ],
                ];

                foreach ($config as $controller => $actions) {
                    $acl->addResource(
                        $controller,
                        array_keys($actions)
                    );
                    foreach ($actions as $action => $roles) {
                        foreach ($roles as $role) {
                            $acl->allow($roles, $controller, $action);
                        }
                    }
                }

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
