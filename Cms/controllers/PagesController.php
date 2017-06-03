<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Page;

class PagesController extends FrontController
{

    public function showAction($id)
    {
        $page = Page::findById($id);
        
        if ($page->active != 1 or $page->content == null) {
            $this->redirect("/");
        }

        if ($page->layout != null) {
            $this->layout = $page->layout;
        }
        
        $this->render('cms::pages::show', array(
            'page'      => $page,
            'pageTitle' => $page->title
        ));
    }
}
