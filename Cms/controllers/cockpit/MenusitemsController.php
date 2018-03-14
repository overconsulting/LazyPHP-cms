<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use Core\Router;
use Core\Session;
use Auth\models\Group;

class MenusitemsController extends CockpitController
{
    /**
     * @var string
     */
    private $pageTitle = '<i class="fa fa-bars fa-green"></i> Gestion des menus';

    /**
     * @var \Cms\models\MenuItems
     */
    private $menuitem = null;

    public function newAction($menu_id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = new MenuItem();
            $this->menuitem->menu_id = $menu_id;
        }

        $parentOptions = $this->getParentOptions($menu_id);
        $groupOptions = Group::getOptions();

        if ($this->menuitem->groups == '') {
            $this->menuitem->groups = array();
            foreach ($groupOptions as $groupOption) {
                $this->menuitem->groups[] = $groupOption['value'];
            }
        }

        $this->render(
            'cms::menusitems::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => '['.$this->menuitem->menu->label.'] - Ajouter un nouvel item au menu',
                'menuitem' => $this->menuitem,
                'parentOptions' => $parentOptions,
                'groupOptions' => $groupOptions,
                'formAction' => Router::url('cockpit_cms_menu_'.$menu_id.'_menusitems_create')
            )
        );
    }

    public function createAction($menu_id)
    {
        if (!isset($this->request->post['groups'])) {
            $this->request->post['groups'] = '';
        } else {
            $this->request->post['groups'] = implode(';', $this->request->post['groups']);
        }

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['connected '])) {
            $this->request->post['connected '] = 0;
        }

        if (!isset($this->request->post['notconnected'])) {
            $this->request->post['notconnected'] = 0;
        }

        if (!isset($this->request->post['important'])) {
            $this->request->post['important'] = 0;
        }

        if (!isset($this->request->post['show_label'])) {
            $this->request->post['show_label'] = 0;
        }

        if (!isset($this->request->post['show_icon'])) {
            $this->request->post['show_icon'] = 0;
        }

        if (!isset($this->request->post['new_window'])) {
            $this->request->post['new_window'] = 0;
        }

        if (!isset($this->request->post['media_id']) || $this->request->post['media_id'] == "") {
            $this->request->post['media_id'] = null;
        }

        $this->menuitem = new MenuItem();

        if ($this->menuitem->save($this->request->post)) {
            $this->addFlash('Menu Item ajouté', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$menu_id);
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function editAction($menu_id, $id)
    {
        if (!isset($this->menuitem)) {
            $this->menuitem = MenuItem::findById($id);
        }

        $parentOptions = $this->getParentOptions($menu_id);
        $groupOptions = Group::getOptions();

        if ($this->menuitem->groups == '') {
            $this->menuitem->groups = array();
            foreach ($groupOptions as $groupOption) {
                $this->menuitem->groups[] = $groupOption['value'];
            }
        }

        $this->render(
            'cms::menusitems::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle'=> '['.$this->menuitem->menu->label.'] - Modifier l\'item du menu',
                'menuitem' => $this->menuitem,
                'parentOptions' => $parentOptions,
                'groupOptions' => $groupOptions,
                'formAction' => Router::url('cockpit_cms_menu_'.$menu_id.'_menusitems_update_'.$id)
            )
        );
    }

    public function updateAction($menu_id, $id)
    {
        if (!isset($this->request->post['groups'])) {
            $this->request->post['groups'] = '';
        } else {
            $this->request->post['groups'] = implode(';', $this->request->post['groups']);
        }

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['show_label'])) {
            $this->request->post['show_label'] = 0;
        }

        if (!isset($this->request->post['connected '])) {
            $this->request->post['connected '] = 0;
        }

        if (!isset($this->request->post['notconnected'])) {
            $this->request->post['notconnected'] = 0;
        }

        if (!isset($this->request->post['important'])) {
            $this->request->post['important'] = 0;
        }

        if (!isset($this->request->post['show_icon'])) {
            $this->request->post['show_icon'] = 0;
        }

        if (!isset($this->request->post['new_window'])) {
            $this->request->post['new_window'] = 0;
        }

        if (!isset($this->request->post['media_id']) || $this->request->post['media_id'] == "") {
            $this->request->post['media_id'] = null;
        }

        $this->menuitem = MenuItem::findById($id);

        if ($this->menuitem->save($this->request->post)) {
            $this->addFlash('Item modifiée', 'success');
            $this->redirect('cockpit_cms_menus_show_'.$this->menuitem->menu_id);
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

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
