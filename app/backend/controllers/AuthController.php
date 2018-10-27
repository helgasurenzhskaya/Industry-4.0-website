<?php

namespace Backend\Controller;

use Phalcon\Mvc\Controller;
use Backend\Forms\AuthLoginForm as Form;

class AuthController extends Controller
{
    public function loginAction()
    {
        $form = new Form();
        try {
            if ($this->request->isPost()) {
//			if ($form->isValid($this->request->getPost()) == false)
//			{
//				foreach ($form->getMessages() as $message)
//				{
//					$this->flash->error($message);
//				}
//			}
//			else
                {
                    $this->auth->check(
                        $this->request->getPost('email'),
                        $this->request->getPost('password')
                    );
                    $this->response->redirect(
                        $this->url->path($this->url->get(['for' => 'backend'])),
                        false,
                        307
                    )->send();
                    die;
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            $this->flash->error($e->getMessage());
        }
        $this->view->setVar('item_form', $form);
    }

    public function logoutAction()
    {
        $this->auth->remove();
        $this->response->redirect('index');
        die;
    }
}
