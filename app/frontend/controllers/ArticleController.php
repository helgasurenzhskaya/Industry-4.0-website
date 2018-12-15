<?php

namespace Frontend;

use Phalcon\Mvc\Controller;
use Article;

class ArticleController extends Controller 
{
    public function showAction() 
    {
        $article = Article::findFirst($this->di->get('dispatcher')->getParam('article_id'));
        if ($article === false) {
            $this->dispatcher->forward(['controller' => 'error', 'action' => 'show404']);
        }
        $this->view->setVar('article', $article);
        $this->view->setVar('page_classes', 'page-article-show');
    }
}
