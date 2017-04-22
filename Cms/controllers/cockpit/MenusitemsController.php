<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use System\Router;
use System\Session;

class MenusitemsController extends CockpitController
{
    public function newAction($menu_id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = new MenuItem();
            $this->menuitem->menu_id = $menu_id;
        }

        $menusItemsOptions = MenuItem::findAll(
            array(
                'column'    => 'menu_id',
                'operator'  => '=',
                'value'     => $menu_id
            )
        );

        $menusOptions = Menu::findAll("site_id = ".Session::get('site_id'));

        $this->render('edit', array(
            'pageTitle'         => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'          => 'Ajouter un nouvel item au menu',
            'menuitem'          => $this->menuitem,
            'menusOptions'      => $menusOptions,
            'menusItemsOptions' => $menusItemsOptions,
            'formAction'        => url('cockpit_cms_menu_'.$menu_id.'_menusitems_create')
        ));
    }

    public function createAction($menu_id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['parent']) || $this->request->post['parent'] == "") {
            $this->request->post['parent'] = null;
        }

        $this->menuitem = new MenuItem();
        $this->menuitem->setData($this->request->post);

        // if ($this->menuitem->valid()) {
        if ($this->menuitem->create((array)$this->menuitem)) {
            Session::addFlash('Menu Item ajouté', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$menu_id);
        } else {
            Session::addFlash('Erreur insertion base de données', 'danger');
        };
        /*} else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->newAction();
    }

    public function editAction($menu_id, $id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = MenuItem::findById($id);
        }

        $menusItemsOptions = MenuItem::findAll(array(
            'column'    => 'menu_id',
            'operator'  => '=',
            'value'     => $this->menuitem->menu_id
        ));
        
        $menusOptions = Menu::findAll();

        $this->render('edit', array(
            'pageTitle'         => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'titleBox'          => 'Modifier l\'item du menu',
            'menuitem'          => $this->menuitem,
            'menusOptions'      => $menusOptions,
            'menusItemsOptions' => $menusItemsOptions,
            'formAction'        => url('cockpit_cms_menu_'.$menu_id.'_menusitems_update_'.$id)
        ));
    }

    public function updateAction($menu_id, $id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['parent']) || $this->request->post['parent'] == "") {
            $this->request->post['parent'] = null;
        }

        $this->menuitem = MenuItem::findById($id);
        $this->menuitem->setData($this->request->post);

        // if ($this->category->valid()) {
        if ($this->menuitem->update((array)$this->menuitem)) {
            Session::addFlash('Item modifiée', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$this->menuitem->menu_id);
        } else {
            Session::addFlash('Erreur mise à jour base de données', 'danger');
        }
        /*} else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->editAction($id);
    }

    public function deleteAction($menu_id, $id)
    {
        $menuitem = MenuItem::findById($id);
        $menuitem->delete();
        Session::addFlash('Menu item supprimé', 'success');
        $this->redirect('cockpit_cms_menus_show_'.$menu_id);
    }
}
