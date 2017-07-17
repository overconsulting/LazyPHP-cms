<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Widget\models\Widget as WidgetList;
use Widget\widgets\Widget;
use Cms\models\Page;
use Core\Router;
use Core\Session;

use Auth\models\Role;

class PagesController extends CockpitController
{
    public function before()
    {
        if (!Role::checkAdministratorPermission($this->current_administrator, 'cms')) {
            Session::addFlash('Vous n\'avez pas l\'autorisation d\'accéder à cette page', 'danger');
            // $this->redirect('/cockpit');
        }
    }

    public function indexAction()
    {
        /* Récuperation des pages de la bdd */
        $pages = Page::findAll("site_id = " . Session::get('site_id'));

        $this->render(
            'cms::pages::index',
            array(
                'pageTitle'     => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
                'boxTitle'      => 'Liste des pages',
                'pages'         => $pages
            )
        );
    }

    public function newAction()
    {
        if (!isset($this->page)) {
            $this->page = new Page();
        }

        $contentJson = json_encode(array(
                'title' => $this->page->title,
                'active' => $this->page->active,
                'sections' => array()
        ));

        $this->render(
            'cms::pages::edit',
            array(
                'page' => $this->page,
                'contentJson' => $contentJson,
                'pageTitle' => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
                'boxTitle' => 'Nouvelle page',
                'formAction' => Router::url('cockpit_cms_pages_create'),
                'fullwidthOptions' => $this->getFullwidthOptions(),
                'fontWeightOptions' => $this->getFontWeightOptions(),
                'widgets' => $this->getWidgets()
            )
        );
    }

    public function editAction($id)
    {
        $this->page = Page::findById($id);

        $contentJson =
            $this->page->content != '' ?
            $this->page->content :
            json_encode(array(
                'title' => $this->page->title,
                'active' => $this->page->active,
                'sections' => array()
            ));

        $this->render(
            'cms::pages::edit',
            array(
                'page' => $this->page,
                'contentJson' => $contentJson,
                'pageTitle' => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
                'boxTitle' => 'Nouvelle page',
                'formAction' => Router::url('cockpit_cms_pages_update_'.$id),
                'fullwidthOptions' => $this->getFullwidthOptions(),
                'fontWeightOptions' => $this->getFontWeightOptions(),
                'widgets' => $this->getWidgets()
            )
        );
    }

    public function createAction()
    {
        $this->page = new Page();

        $post = $this->request->post;
        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        if (!isset($post['show_page_title'])) {
            $post['show_page_title'] = 0;
        }

        $post['site_id'] = Session::get('site_id');

        if ($this->page->save($post)) {
            Session::addFlash('Page ajoutée', 'success');
            $this->redirect('cockpit_cms_pages_index');
        } else {
            Session::addFlash('Erreur mise à jour base de données', 'danger');
        }

        $this->editAction($id);
    }

    public function updateAction($id)
    {
        $this->page = Page::findById($id);

        $post = $this->request->post;
        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        if (!isset($post['show_page_title'])) {
            $post['show_page_title'] = 0;
        }

        $post['site_id'] = Session::get('site_id');

        if ($this->page->save($post)) {
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
        Session::addFlash('Page supprimée', 'success');
        $this->redirect('cockpit_cms_pages_index');
    }

    private function getFullwidthOptions()
    {
        return array(
            array('label' => 'Pleine largeur (container-fluid)', 'value' => '1'),
            array('label' => 'Recadré (container)', 'value' => '0')
        );
    }

    private function getFontWeightOptions()
    {
        return array(
            array('label' => '---', 'value' => ''),
            array('label' => 'normal', 'value' => 'normal'),
            array('label' => 'bold', 'value' => 'bold'),
            array('label' => 'bolder', 'value' => 'bolder'),
            array('label' => 'lighter', 'value' => 'lighter'),
            array('label' => '100', 'value' => '100'),
            array('label' => '200', 'value' => '200'),
            array('label' => '300', 'value' => '300'),
            array('label' => '400', 'value' => '400'),
            array('label' => '500', 'value' => '500'),
            array('label' => '600', 'value' => '600'),
            array('label' => '700', 'value' => '700'),
            array('label' => '800', 'value' => '800'),
            array('label' => '900', 'value' => '900')
        );
    }

    private function getWidgets()
    {
        $widgetList = WidgetList::findAll();

        $widgets = array();
        foreach ($widgetList as $wl) {
            $widgets[$wl->type] = (array)$wl;

            $class = Widget::$widgetTypes[$wl->type];
            if (method_exists($class, 'getDbModel')) {
                $dbModel = $class::getDbModel();
                if ($dbModel !== null) {
                    $widgets[$wl->type]['items'] = $dbModel::findAll();
                }
            }
        }

        return $widgets;
    }
}
