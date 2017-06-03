<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Article;

class ArticlesController extends FrontController
{
    public function indexAction()
    {
        $articles = Article::findAll("site_id = " . $this->session['site_id']);

        $this->render(
            'cms::articles::index',
            array(
                'articles'   => $articles,
                'pageTitle'  => 'Articles'
            )
        );
    }

    public function showAction($id)
    {
        $article = Article::findById($id);
        
        $this->render('cms::articles::show', array(
            'article'   => $article,
            'pageTitle' => $article->title
        ));
    }
}
