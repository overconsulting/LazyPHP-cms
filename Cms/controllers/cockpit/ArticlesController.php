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
        $articles = Article::findAll("site_id = " . Session::get('site_id'));

        $this->render('index', array(
            'articles' => $articles,
            'titlePage' => '<i class="fa fa-columns fa-red"></i> Gestion des articles',
            'titleBox'     => 'Listes des articles',
        ));
    }

    public function showAction($id)
    {
        $article = Article::findById($id);

        $this->render('show', array(
            'article'       => $article,
            'titlePage'     => '<i class="fa fa-columns fa-red"></i> Gestion des articles',
            'titleBox'      => 'Article n°'.$article->title,
        ));
    }

    public function newAction()
    {
        if (!isset($this->article)) {
            $this->article = new Article();
        }

        $author = User::findAll();

        $this->render('edit', array(
            'id'            => 0,
            'article'       => $this->article,
            'titlePage'     => '<i class="fa fa-columns fa-red"></i> Gestion des articles',
            'titleBox'      => 'Ajouter un nouvel article',
            'formAction'    => url('cockpit_cms_articles_create'),
            'authorOptions' => $author
        ));
    }

    public function editAction($id)
    {
        if (!isset($this->article)) {
            $this->article = Article::findById($id);
        }

        $this->render('edit', array(
            'id'            => $id,
            'article'       => $this->article,
            'titlePage'     => '<i class="fa fa-columns fa-red"></i> Gestion des articles',
            'titleBox'      => 'Editer l\'article n°'.$id,
            'formAction'    => url('cockpit_cms_articles_update', array('id' => $id)),
            'authorOptions' => User::findAll()
        ));
    }

    public function createAction()
    {
        $this->article = new Article();
        $this->request->post['site_id'] = Session::get("site_id");
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
        $this->request->post['site_id'] = Session::get("site_id");
        $this->article->setData($this->request->post);

        if ($this->article->valid()) {
            if ($this->article->update((array)$this->article)) {
                Session::addFlash('Article modifié', 'success');
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
