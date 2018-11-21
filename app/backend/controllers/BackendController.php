<?php

namespace Backend\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Dispatcher;
use Exception;

abstract class BackendController extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();
        
        // // If there is no identity available the user is redirected to auth/login.
        if ($this->auth->isLoggedIn() === false) {
            $this->flashSession->notice('You don\'t have access to this module: private');
            $this->response->redirect(
                $this->url->path($this->url->get(['for' => 'backend/login'])),
                false,
                307
            )->send();
            die;
        }

        $user = $this->auth->getUser();
        // Check if the user have permission to the current option.
        if ($this->acl->isAllowed($user->getRole(), $controllerName, $actionName) === false) {
            $this->flashSession->notice(
                'You don\'t have access to this module: ' . $controllerName . ':' . $actionName
            );
            $this->response->redirect(
                $this->url->path($this->url->get(['for' => 'backend/login'])),
                false,
                307
            )->send();
            die;
            return false;
        }
    }
}
