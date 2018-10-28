<?php

namespace Backend\Controller;

use Page;
use Backend\Forms\PageAddEditForm;

class PageController extends BackendController
{
    public function listAction()
    {

    }

    public function addAction()
    {

    }

    public function editAction()
    {
        $item = Page::findFirst($this->dispatcher->getParam('page_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $form = new PageAddEditForm($item);
        // TODO: post
        $this->view->setVar('item_form', $form);
    }

    public function deleteAction()
    {

    }
}
