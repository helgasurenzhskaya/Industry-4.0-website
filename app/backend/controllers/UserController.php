<?php

namespace Backend\Controller;

use User;
use Backend\Forms\UserAddEditForm;

class UserController extends BackendController
{
    public function listAction()
    {

    }

    public function addAction()
    {

    }

    public function editAction()
    {
        $item = User::findFirst($this->dispatcher->getParam('user_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $form = new UserAddEditForm($item);
        // TODO: post
        $this->view->setVar('item_form', $form);
    }

    public function deleteAction()
    {

    }
}
