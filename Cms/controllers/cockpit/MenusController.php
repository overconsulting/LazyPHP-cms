<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use Core\Session;
use Core\Router;

class MenusController extends CockpitController
{
    public function indexAction()
    {
        $menus = Menu::findAll("site_id = ".Session::get("site_id"));

        $this->render('index', array(
            'pageTitle' => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'  => 'Liste des menus',
            'menus'     => $menus
        ));
    }

    public function newAction()
    {
        if (!isset($this->menu)) {
            $this->menu = new Menu();
        }

        $this->render('edit', array(
            'pageTitle'     => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'      => 'Ajouter un menu',
            'formAction'    => Router::url('cockpit_cms_menus_create')
        ));
    }

    public function showAction($id)
    {
        $this->menu = Menu::findById($id);

        $this->render('show', array(
            'pageTitle'     => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'      => 'Menu : '.$this->menu->label,
            'menu'          => $this->menu,
            'items'         => MenuItem::getFlat(null, "menu_id = ".$this->menu->id)
        ));
    }

    public function createAction()
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }
        
        if (!isset($this->request->post['principal'])) {
            $this->request->post['principal'] = 0;
        }

        $this->request->post['site_id'] = Session::get("site_id");

        $this->menu = new Menu();
        $this->menu->setData($this->request->post);

        // if ($this->menu->valid()) {
        if ($this->menu->create((array)$this->menu)) {
            Session::addFlash('Menu ajouté', 'success');
            $this->redirect('cockpit_cms_menus');
        } else {
            Session::addFlash('Erreur insertion base de données', 'danger');
        };
        /*} else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->newAction();
    }

    public function editAction($id)
    {
        if (!isset($this->menu)) {
            $this->menu = Menu::findById($id);
        }

        $this->render('edit', array(
            'pageTitle'     => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'      => 'Modifier le menu',
            'menu'              => $this->menu,
            'formAction'        => url('cockpit_cms_menus_update_'.$id)
        ));
    }

    public function updateAction($id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['principal'])) {
            $this->request->post['principal'] = 0;
        }

        $this->request->post['site_id'] = Session::get("site_id");

        $this->menu = Menu::findById($id);
        $this->menu->setData($this->request->post);

        // if ($this->category->valid()) {
        if ($this->menu->update((array)$this->menu)) {
            Session::addFlash('Menu modifié', 'success');
            $this->redirect('cockpit_cms_menus');
        } else {
            Session::addFlash('Erreur mise à jour base de données', 'danger');
        }
        /*} else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $menu = Menu::findById($id);
        $menu->delete();
        Session::addFlash('Menu supprimé', 'success');
        $this->redirect('cockpit_cms_menus');
    }
}
