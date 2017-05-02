<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Page;

class PagesController extends FrontController
{

    public function showAction($id)
    {
        $page = Page::findById($id);
        
        if ($page->active != 1) {
            $this->redirect("/");
        }
        
        $this->render('show', array(
            'page'      => $page,
            'pageTitle' => $page->title
        ));
    }
}
