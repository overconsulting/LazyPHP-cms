<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Article;
use System\Session;

class ArticlesController extends FrontController
{
    public function indexAction()
    {
        $articles = Article::findAll("site_id = " . Session::get('site_id'));

        $this->render(
            'index',
            array(
                'articles'   => $articles,
                'pageTitle'  => 'Articles'
            )
        );
    }

    public function showAction($id)
    {
        $article = Article::findById($id);
        
        $this->render('show', array(
            'article'   => $article,
            'pageTitle' => $article->title
        ));
    }
}
