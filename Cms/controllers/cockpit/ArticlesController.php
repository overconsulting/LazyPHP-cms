<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;

use Cms\models\Article;
use Cms\models\ArticleCategory;
use Auth\models\User;
use Core\models\Site;
use Core\Router;
use Core\Session;

class ArticlesController extends CockpitController
{
    private $article = null;
    private $pageTitle = '<i class="fa fa-columns fa-red"></i> Gestion des articles';

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
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Liste des articles'
            )
        );
    }

    public function showAction($id)
    {
        $this->article = Article::findById($id);

        $this->render(
            'cms::articles::show',
            array(
                'article' => $this->article,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Article n° '.$this->article->id
            )
        );
    }

    public function newAction()
    {
        if (!isset($this->article)) {
            $this->article = new Article();
        }

        $userOptions = User::findAll();
        $articleCategoryOptions = ArticleCategory::getOptions();
        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articles::edit',
            array(
                'article' => $this->article,
                'pageTitle' => $this->title,
                'boxTitle' => 'Ajouter un nouvel article',
                'formAction' => Router::url('cockpit_cms_articles_create'),
                'userOptions' => $userOptions,
                'articleCategoryOptions' => $articleCategoryOptions,
                'siteOptions' => $siteOptions,
                'selectSite' => $this->current_administrator->site_id === null
            )
        );
    }

    public function editAction($id)
    {
        if (!isset($this->article)) {
            $this->article = Article::findById($id);
        }

        $userOptions = User::findAll();
        $articleCategoryOptions = ArticleCategory::getOptions();
        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articles::edit',
            array(
                'article'=> $this->article,
                'pageTitle' => $this->title,
                'boxTitle' => 'Modifier l\'article n° '.$id,
                'formAction' => Router::url('cockpit_cms_articles_update', array('id' => $id)),
                'userOptions' => $userOptions,
                'articleCategoryOptions' => $articleCategoryOptions,
                'siteOptions' => $siteOptions,
                'selectSite' => $this->current_administrator->site_id === null
            )
        );
    }

    public function createAction()
    {
        $this->article = new Article();

        if (!isset($this->request->post['site_id'])) {
            $this->request->post['site_id'] = $this->site->id;
        }

        if ($this->article->save($this->request->post)) {
            $this->addFlash('Article ajouté', 'success');
            $this->redirect('cockpit_cms_articles');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function updateAction($id)
    {
        $this->article = Article::findById($id);

        if (!isset($this->request->post['site_id'])) {
            $this->request->post['site_id'] = $this->site->id;
        }

        if ($this->article->save($this->request->post)) {
            $this->addFlash('Article modifié', 'success');
            $this->redirect('cockpit_cms_articles');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $article = Article::findById($id);
        $article->delete();
        $this->addFlash('Article supprimé', 'success');
        $this->redirect('cockpit_cms_articles');
    }
}
