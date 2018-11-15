<?php

namespace Backend\Controller;

use Article;
use Backend\Forms\ArticleAddEditForm;

class ArticleController extends BackendController
{
    public function listAction()
    {

    }

    public function addAction()
    {

    }

    public function editAction()
    {
        $item = Article::findFirst($this->dispatcher->getParam('article_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $form = new ArticleAddEditForm($item);
        // TODO: post
        $this->view->setVar('item_form', $form);
    }

    public function deleteAction()
    {

    }
}
