<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Cms\models\ArticleCategory;
use Core\Session;
use Core\Router;
use Core\models\Site;

class ArticlecategoriesController extends CockpitController
{
    private $articleCategory = null;
    private $pageTitle = '<i class="fa fa-columns fa-red"></i> Gestion des catégories d\'article';

    public function indexAction()
    {
        if ($this->site !== null) {
            $where = 'site_id = '.$this->site->id;
        } else {
            $where = '';
        }
        $articleCategories = ArticleCategory::findAll($where);

        $this->render(
            'cms::articlecategories::index',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Liste des des catégories d\'article',
                'articleCategories' => $articleCategories
            )
        );
    }

    public function newAction()
    {
        if (!isset($this->articleCategory)) {
            $this->articleCategory = new ArticleCategory();
        }

        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articlecategories::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Nouvellle catégorie d\'article',
                'articleCategory' => $this->articleCategory,
                'selectSite' => $this->current_user->site_id === null,
                'siteOptions' => $siteOptions,
                'formAction' => Router::url('cockpit_cms_articlecategories_create')
            )
        );
    }

    public function editAction($id)
    {
        if (!isset($this->articleCategory)) {
            $this->articleCategory = ArticleCategory::findById($id);
        }

        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articlecategories::edit',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Modification de la catégorie d\'article',
                'articleCategory' => $this->articleCategory,
                'siteOptions' => $siteOptions,
                'selectSite' => $this->current_user->site_id === null,
                'formAction' => Router::url('cockpit_cms_articlecategories_update_'.$this->articleCategory->id)
            )
        );
    }

    public function createAction()
    {
        $this->articleCategory = new ArticleCategory();

        if (!isset($this->request->post['site_id'])) {
            $this->request->post['site_id'] = $this->site->id;
        }

        if ($this->articleCategory->save($this->request->post)) {
            $this->addFlash('Catégorie d\'article modifiée', 'success');
            $this->redirect('cockpit_cms_articlecategories');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function updateAction($id)
    {
        $this->articleCategory = ArticleCategory::findById($id);

        if (!isset($this->request->post['site_id'])) {
            $this->request->post['site_id'] = $this->site->id;
        }

        if ($this->articleCategory->save($this->request->post)) {
            $this->addFlash('Catégorie d\'article modifiée', 'success');
            $this->redirect('cockpit_cms_articlecategories');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $articleCategory = ArticleCategory::findById($id);
        $articleCategory->delete();
        $this->addFlash('Catégorie d\'article supprimée', 'success');
        $this->redirect('cockpit_cms_articlecategories');
    }
}
