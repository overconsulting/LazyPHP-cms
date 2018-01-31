<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Core\Mail;

class PagesController extends FrontController
{
    public function showAction($id)
    {
        // Mail::send('contact@fitnss.fr', 'Contact', 'ldandoy@gmail.com', 'Loïc DANDOY', 'Sujet test', 'Message de Test');

        $pageClass = $this->loadModel('Page');
        $page = $pageClass::getLastRevision($id, 'published');

        if ($page === null || $page->site_id != $this->site->id) {
            $this->redirect('/');
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
