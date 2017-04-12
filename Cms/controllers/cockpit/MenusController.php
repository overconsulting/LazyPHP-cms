<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use system\Session;

class MenusController extends CockpitController
{
    public function indexAction()
    {
        // $menus = Menu::getChildren(null, true, 0, true);
        $menus = Menu::findAll();

        $this->render('index', array(
            'menus' => $menus
        ));
    }

    public function newAction()
    {
        if (!isset($this->menu)) {
            $this->menu = new Menu();
        }

        $this->render('edit', array(
            'pageTitle'     => 'Nouveau menu',
            'formAction'    => Router::url('cockpit_cms_menus_create')
        ));
    }

    public function showAction($id)
    {
        $this->menu = Menu::findById($id);

        $this->render('show', array(
            'pageTitle'     => 'Editer le menu '.$this->menu->label,
            'menu'          => $this->menu,
            'items'         => MenuItem::getFlat(null, "menu_id = ".$this->menu->id)
        ));
    }

    public function createAction()
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

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
            'pageTitle'         => 'Nouveau menu',
            'menu'              => $this->menu,
            'formAction'        => url('cockpit_cms_menus_update_'.$id)
        ));
    }

    public function updateAction($id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        $this->menu = Menu::findById($id);
        $this->menu->setData($this->request->post);

        // if ($this->category->valid()) {
        if ($this->menu->update((array)$this->menu)) {
            Session::addFlash('Catégorie modifiée', 'success');
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
