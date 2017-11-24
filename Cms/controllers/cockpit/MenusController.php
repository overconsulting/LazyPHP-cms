<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\Menu;
use Cms\models\MenuItem;
use Core\Session;
use Core\Router;
use Auth\models\Group;

class MenusController extends CockpitController
{
    /**
     * @var string
     */
    private $pageTitle = '<i class="fa fa-bars fa-green"></i> Gestion des menus';

    /**
     * @var \Cms\models\Menu
     */
    private $menu = null;

    public function indexAction()
    {
        if ($this->current_user->site_id !== null) {
            $where = 'site_id = '.$this->current_user->site_id;
        } else {
            $where = '';
        }
        $menus = Menu::findAll($where);

        $positionOptions = Menu::getPositionOptions();

        $this->render(
            'cms::menus::index',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Liste des menus',
                'positionOptions' => $positionOptions,
                'menus' => $menus
            )
        );
    }

    public function newAction()
    {
        if (!isset($this->menu)) {
            $this->menu = new Menu();
        }

        $positionOptions = Menu::getPositionOptions();

        $this->render(
            'cms::menus::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Ajouter un menu',
                'menu' => $this->menu,
                'positionOptions' => $positionOptions,
                'formAction' => Router::url('cockpit_cms_menus_create')
            )
        );
    }

    public function showAction($id)
    {
        $this->menu = Menu::findById($id);

        $groupOptions = Group::getOptions();

        $this->render(
            'cms::menus::show',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Menu : '.$this->menu->label,
                'menu' => $this->menu,
                'groupOptions' => $groupOptions,
                'items' => MenuItem::getFlat(null, "menu_id = ".$this->menu->id)
            )
        );
    }

    public function createAction()
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['principal'])) {
            $this->request->post['principal'] = 0;
        }

        $this->request->post['site_id'] = $this->site->id;

        $this->menu = new Menu();

        if ($this->menu->save($this->request->post)) {
            $this->addFlash('Menu ajouté', 'success');
            $this->redirect('cockpit_cms_menus');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function editAction($id)
    {
        if (!isset($this->menu)) {
            $this->menu = Menu::findById($id);
        }

        $positionOptions = Menu::getPositionOptions();

        $this->render(
            'cms::menus::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Modifier le menu',
                'menu' => $this->menu,
                'positionOptions' => $positionOptions,
                'formAction' => Router::url('cockpit_cms_menus_update_'.$id)
            )
        );
    }

    public function updateAction($id)
    {
        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['principal'])) {
            $this->request->post['principal'] = 0;
        }

        $this->request->post['site_id'] = $this->site->id;

        $this->menu = Menu::findById($id);

        if ($this->menu->save($this->request->post)) {
            $this->addFlash('Menu modifié', 'success');
            $this->redirect('cockpit_cms_menus');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $menu = Menu::findById($id);
        $menu->delete();
        $this->addFlash('Menu supprimé', 'success');
        $this->redirect('cockpit_cms_menus');
    }
}
