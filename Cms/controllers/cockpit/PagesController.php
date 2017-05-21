<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Widget\models\Widget as WidgetList;
use Widget\widgets\Widget;
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

        $contentJson = json_encode(array(
                'title' => $this->page->title,
                'active' => $this->page->active,
                'sections' => array()
        ));

        $this->render('edit', array(
            'page' => $this->page,
            'contentJson' => $contentJson,
            'pageTitle' => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
            'boxTitle' => 'Nouvelle page',
            'formAction' => Router::url('cockpit_cms_pages_create'),
            'fontWeightOptions' => $this->getFontWeightOptions(),
            'widgets' => $this->getWidgets()
        ));
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

        $this->render('edit', array(
            'page' => $this->page,
            'contentJson' => $contentJson,
            'pageTitle' => '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages',
            'boxTitle' => 'Modifier la page: '.$this->page->title,
            'formAction' => Router::url('cockpit_cms_pages_update_'.$id),
            'fontWeightOptions' => $this->getFontWeightOptions(),
            'widgets' => $this->getWidgets()
        ));
    }

    public function createAction()
    {
        $this->page = new Page();

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['show_page_title'])) {
            $this->request->post['show_page_title'] = 0;
        }

        $this->request->post['site_id'] = Session::get('site_id');

        if ($this->page->save($this->request->post)) {
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

        if (!isset($this->request->post['active'])) {
            $this->request->post['active'] = 0;
        }

        if (!isset($this->request->post['show_page_title'])) {
            $this->request->post['show_page_title'] = 0;
        }

        $this->request->post['site_id'] = Session::get('site_id');

        if ($this->page->save($this->request->post)) {
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
            $class = Widget::$widgetTypes[$wl->type];
            $dbModel = $class::getDbModel();
            $widgets[$wl->type] = (array)$wl;
            $widgets[$wl->type]['items'] = $dbModel::findAll();
        }

        return $widgets;
    }
}
