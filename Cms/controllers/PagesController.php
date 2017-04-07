<?php

namespace Cms\controllers;

use app\controllers\FrontController;
use Cms\models\Page;

class PagesController extends FrontController
{

    public function showAction($id)
    {
        $page = Page::findById($id);
        
        $this->render('show', array(
            'page'      => $page,
            'title'     => $page->title
        ));
    }
}
