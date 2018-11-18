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
        $item = new User();
        $form = new UserAddEditForm($item);
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
        $item = User::findFirst($this->dispatcher->getParam('user_id'));
        if ($item === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $form = new UserAddEditForm($item);
        if ($this->request->isPost()) {
          
            if ($form->isValid()) {
                try {
                    if ($item->save() === false) {
                        throw new Exception();
                    }

                    if ($this->request->hasFiles(true)) {
                        $files = $this->request->getUploadedFiles();
                        foreach ($files as $file) {
                            if ($file->getKey() !== 'image') {
                                continue;
                            }
                            $item->updateImage($file);
                            break;
                        }
                    }

                    $this->flashSession->success('Saved.');
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
        $this->view->setVar('item_form', $form);
    }

    public function deleteAction()
    {
        $item = User::findFirst($this->dispatcher->getParam('user_id'));
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
                    'for' => 'backend/user/list',
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
