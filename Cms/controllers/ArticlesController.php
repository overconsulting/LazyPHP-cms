<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use app\models\Article;

class ArticlesController extends FrontController
{
    public function indexAction()
    {
        $articles = Article::findAll();

        $this->render(
            'index',
            array(
                'articles'   => $articles,
                'titre'      => 'Articles'
            )
        );
    }

    public function showAction($id)
    {
        $article = Article::findById($id);
        
        $this->render('show', array(
            'article'   => $article,
            'title'     => $article->title
        ));
    }
}
