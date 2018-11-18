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
        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $form->getEntity());
             if ($form->isValid())
            {
                try
                {
                    if ($item->save() === false)
                    {
                        throw new Exception();
                    }
                     $this->flashSession->success('Saved');
                }
                catch (Exception $e)
                {
                    $messages = $item->getMessages();
                    if ($messages)
                    {
                        foreach ($messages as $message)
                        {
                            $this->flashSession->error($message->getMessage());
                        }
                    }
                    else
                    {
                        $this->flashSession->error($e->getMessage());
                    }
                }
            }
        }
        $this->view->setVar('item_form', $form);
    }

    public function deleteAction()
    {

    }

}
