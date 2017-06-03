<?php

namespace Cms\controllers;

use app\controllers\FrontController;

class PagesController extends FrontController
{

    public function showAction($id)
    {
        $pageModel = $this->loadModel('Page');
        $page = $pageModel::findById($id);

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
