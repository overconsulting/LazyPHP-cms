<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Article;
use Cms\models\ArticleCategory;

class ArticlesController extends FrontController
{
    public function indexAction()
    {
        if ($this->site !== null) {
            $where = 'site_id = '.$this->site->id;
        } else {
            $where = '';
        }
        $articles = Article::findAll($where);

        $this->render(
            'cms::articles::index',
            array(
                'articles' => $articles,
                'pageTitle' => 'Liste des articles'
            )
        );
    }

    public function showAction($id)
    {
        $article = Article::findById($id);
        
        $this->render(
            'cms::articles::show',
            array(
                'article' => $article,
                'pageTitle' => $article->title
            )
        );
    }

    public function categoryAction($id)
    {
        if (is_numeric($id)) {
            $articlecategory_id = $id;
        } else {
            $articleCategory = ArticleCategory::findByCode($id);
            $articlecategory_id = $articleCategory->id;
        }
        $where = 'articlecategory_id = '.$articlecategory_id;

        if ($this->site !== null) {
            $where .= ' and site_id = '.$this->site->id;
        }

        $articles = Article::findAll($where);

        $this->render(
            'cms::articles::index',
            array(
                'articles' => $articles,
                'pageTitle' => 'Actualités'
            )
        );
    }
}
