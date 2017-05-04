<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Page;
use System\Router;
use System\Session;

class PagesController extends CockpitController
{

    public function indexAction()
    {
        /* Récuperation des pages de la bdd */
        $pages = Page::findAll("site_id = " . Session::get('site_id'));

        $this->render(
            'index',
            array(
                'titlePage'     => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
                'titleBox'      => 'Liste des pages',
                'pages'         => $pages
            )
        );
    }

    public function newAction()
    {
        if (!isset($this->page)) {
            $this->page = new Page();
        }

        $post = $this->request->post;
        $errors = array();
        $this->render('edit', array(
            'formAction'    => Router::url('cockpit_cms_pages_create'),
            'page'          => $this->page,
            'titlePage'     => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
            'titleBox'      => 'Ajouter une page',
        ));
    }

    public function createAction()
    {
        $this->page = new Page();

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }
        $this->request->post['site_id'] = Session::get("site_id");
        if ($this->page->create($this->request->post)) {
            $this->redirect('cockpit_cms_pages_index');
        }

        $this->editAction($id);
    }

    public function editAction($id)
    {
        $post = $this->request->post;
        $errors = array();
        
        $this->page = Page::findById($id);

        $this->render('edit', array(
            'page'          =>  $this->page,
            'titlePage'     => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
            'titleBox'      => 'Modifier la page: '.$this->page->title,
            'formAction'    => Router::url('cockpit_cms_pages_update_'.$id)
        ));
    }

    public function updateAction($id)
    {
        $this->page = Page::findById($id);

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }
        $this->request->post['site_id'] = Session::get("site_id");
        $post = $this->request->post;

        if ($this->page->update($post)) {
            Session::addFlash('Page modifiée', 'success');
            $this->redirect('cockpit_cms_pages_edit_'.$id);
        } else {
            Session::addFlash('Erreur mise à jour base de données', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $page = Page::findById($id);
        $page->delete();
        Session::addFlash('Page supprimé', 'success');
        $this->redirect('cockpit_cms_pages_index');
    }
}
