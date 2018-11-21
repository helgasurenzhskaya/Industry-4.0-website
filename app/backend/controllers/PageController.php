<?php

namespace Backend\Controller;

use Exception;
use Page;
use Backend\Forms\PageAddEditForm;

class PageController extends BackendController
{
    public function listAction()
    {

    }

    public function addAction()
    {
        $item = new Page();
        $form = new PageAddEditForm($item);
        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $form->getEntity());
            if ($form->isValid()) {
                try {
                    if ($item->save() === false) {
                        throw new Exception();
                    }
                    $this->flashSession->success('Saved.');
                    $this->response->redirect($item->getLinkBackendEdit(), false, 200);
                }
                catch (Exception $e) {
                    $messages = $item->getMessages();
                    if ($messages) {
                        foreach ($messages as $message) {
                            $this->flashSession->error($message->getMessage());
                        }
                    } else {
                        $this->flashSession->error($e->getMessage());
                    }
                }
            }
        }
        $this->view->setVar('item_form', $form);
    }

    public function editAction()
    {
        $item = Page::findFirst($this->dispatcher->getParam('page_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $form = new PageAddEditForm($item);

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
        $item = Page::findFirst($this->dispatcher->getParam('page_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        try {
            if ($item->delete() === false) {
                throw new Exception();
            }
            $this->flashSession->success('Deleted.');
            $this->response->redirect(
                [
                    'for' => 'backend/page/list',
                ],
                false,
                200
            );
        } catch (Exception $e) {
            $messages = $item->getMessages();
            if ($messages) {
                foreach ($messages as $message) {
                    $this->flashSession->error($message->getMessage());
                }
            } else {
                $this->flashSession->error($e->getMessage());
            }
        }
    }
}
