<?php

namespace Backend\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher as Dispatcher;

class ErrorController extends Controller
{
    public function show404Action()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
