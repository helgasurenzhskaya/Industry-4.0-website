<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class ErrorController extends Controller 
{
    public function show404Action() 
    {
        $this->view->setRenderLevel(View::LEVEL_AFTER_TEMPLATE);
        $this->response->setStatusCode(404); 
    }

    public function show500Action() 
    {
        $this->view->setRenderLevel(View::LEVEL_AFTER_TEMPLATE);
        $this->response->setStatusCode(500); 
    }
}
