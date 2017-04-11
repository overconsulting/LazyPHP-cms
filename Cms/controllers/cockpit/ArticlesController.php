<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;

use Cms\models\Article;
use Auth\models\User;

use System\Router;
use System\Session;

class ArticlesController extends CockpitController
{
    public function indexAction()
    {
        $articles = Article::findAll();

        $this->render('index', array(
            'articles' => $articles,
            'pageTitle' => '<i class="fa fa-columns"></i> Articles',
        ));
    }

    public function showAction($id)
    {
        $article = Article::findById($id);

        $this->render('show', array(
            'article' => $article,
            'pageTitle' => '<i class="fa fa-columns"></i> Articles',
        ));
    }

    public function newAction()
    {
        if ($this->article === null) {
            $this->article = new Article();
        }

        $author = User::findAll();

        $this->render('edit', array(
            'id'         => 0,
            'article'    => $this->article,
            'pageTitle'  => 'Nouvel article',
            'formAction' => url('cockpit_cms_articles_create'),
            'authorOptions' => $author
        ));
    }

    public function editAction($id)
    {
        if (!isset($this->article)) {
            $this->article = Article::findById($id);
        }

        $this->render('edit', array(
            'id'         => $id,
            'article'    => $this->article,
            'pageTitle'  => 'Editer l\'article n°'.$id,
            'formAction' => url('cockpit_cms_articles_update', array('id' => $id)),
            'authorOptions' => User::findAll()
        ));
    }

    public function createAction()
    {
        $this->article = new Article();
        $this->article->setData($this->request->post);

        if ($this->article->valid()) {
            if ($this->article->create((array)$this->article)) {
                Session::addFlash('Article ajouté', 'success');
                $this->redirect('cockpit_cms_articles');
            } else {
                Session::addFlash('Erreur insertion base de données', 'danger');
            };
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function updateAction($id)
    {
        $this->article = Article::findById($id);
        $this->article->setData($this->request->post);

        if ($this->article->valid()) {
            if ($this->article->update((array)$this->article)) {
                Session::addFlash('Utilisateur modifié', 'success');
                $this->redirect('cockpit_cms_articles');
            } else {
                Session::addFlash('Erreur mise à jour base de données', 'danger');
            }
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $article = Article::findById($id);
        $article->delete();
        Session::addFlash('Article supprimé', 'success');
        $this->redirect('cockpit_cms_articles');
    }
}
