<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use Core\Router;
use Core\Session;

class MenusitemsController extends CockpitController
{
    public function newAction($menu_id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = new MenuItem();
            $this->menuitem->menu_id = $menu_id;
        }

        $parentOptions = $this->getParentOptions($menu_id);

        $this->render('cms::menusitems::edit', array(
            'pageTitle' => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
            'boxTitle' => '['.$this->menuitem->menu->label.'] - Ajouter un nouvel item au menu',
            'menuitem' => $this->menuitem,
            'parentOptions' => $parentOptions,
            'formAction' => url('cockpit_cms_menu_'.$menu_id.'_menusitems_create')
        ));
    }

    public function createAction($menu_id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['media_id']) || $this->request->post['media_id'] == "") {
            $this->request->post['media_id'] = null;
        }

        $this->menuitem = new MenuItem();

        if ($this->menuitem->save($this->request->post)) {
            $this->addFlash('Menu Item ajouté', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$menu_id);
        } else {
            $this->addFlash('Erreur insertion base de données', 'danger');
        };
        /*} else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->newAction();
    }

    public function editAction($menu_id, $id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = MenuItem::findById($id);
        }

        $parentOptions = $this->getParentOptions($menu_id);

        $this->render(
            'cms::menusitems::edit',
            array(
                'pageTitle' => '<i class="fa fa-bars fa-green"></i> Gestion des menus',
                'boxTitle'=> '['.$this->menuitem->menu->label.'] - Modifier l\'item du menu',
                'menuitem' => $this->menuitem,
                'parentOptions' => $parentOptions,
                'formAction' => url('cockpit_cms_menu_'.$menu_id.'_menusitems_update_'.$id)
            )
        );
    }

    public function updateAction($menu_id, $id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['media_id']) || $this->request->post['media_id'] == "") {
            $this->request->post['media_id'] = null;
        }

        $this->menuitem = MenuItem::findById($id);

        if ($this->menuitem->save($this->request->post)) {
            $this->addFlash('Item modifiée', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$this->menuitem->menu_id);
        } else {
            $this->addFlash('Erreur mise à jour base de données', 'danger');
        }
        /*} else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }*/

        $this->editAction($id);
    }

    public function deleteAction($menu_id, $id)
    {
        $menuitem = MenuItem::findById($id);
        $menuitem->delete();
        $this->addFlash('Menu item supprimé', 'success');
        $this->redirect('cockpit_cms_menus_show_'.$menu_id);
    }

    private function getParentOptions($menu_id)
    {
        $options = array(
            0 => array(
                'value' => '',
                'label' => '---'
            )
        );

        $menuItems = MenuItem::getChildren(null, true, 0, true, 'menu_id='.$menu_id);

        foreach ($menuItems as $menuItem) {
            $options[$menuItem->id] = array(
                'value' => $menuItem->id,
                'label' => str_repeat('&nbsp;', $menuItem->level * 8).$menuItem->label
            );
        }

        return $options;
    }
}
