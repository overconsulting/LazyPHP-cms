<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Core\Mail;

class PagesController extends FrontController
{
    public function showAction($id)
    {
        $pageClass = $this->loadModel('Page');
        $page = $pageClass::getLastRevision($id, 'published');

        if ($page === null || $page->active == 0) {
            // $this->redirect('/');
            $this->error("Erreur de page", "La page que vous cherchez n'existe pas.");
        }

        if ($page->site_id != $this->site->id) {
            $this->error("Erreur de page", "Vous ne pouvez pas accéder à cette page.");
        }

        if ($page->layout != '') {
            $this->layout = $page->layout;
        }

        $this->meta_description = $page->meta_description;

        $this->render(
            'cms::pages::show',
            array(
                'page' => $page,
                'pageTitle' => $page->title
            )
        );
    }
}
