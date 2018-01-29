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
        $articleClass = $this->loadModel('Article');
        $articles = $articleClass::getAll($where);

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
        $articleClass = $this->loadModel('Article');
        $article = $articleClass::getLastRevision($id, 'published');

        if ($article === null) {
            $this->redirect("/articles");
            $this->addFlash('L\'article n\'est pas accessible.', 'danger');
        }
        
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
        $articleClass = $this->loadModel('Article');
        $articleCategoryClass = $this->loadModel('ArticleCategory');

        if (is_numeric($id)) {
            $articlecategory_id = $id;
        } else {
            $articleCategory = $articleCategoryClass::findByCode($id);
            $articlecategory_id = $articleCategory->id;
        }
        $where = 'articlecategory_id = '.$articlecategory_id;

        if ($this->site !== null) {
            $where .= ' and site_id = '.$this->site->id;
        }

        $articles = $articleClass::findAll($where);

        $this->render(
            'cms::articles::index',
            array(
                'articles' => $articles,
                'pageTitle' => 'Actualités'
            )
        );
    }
}
