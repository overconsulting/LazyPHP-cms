<?php

namespace Cms\models;

use Core\Model;

class Page extends Model
{
    protected $permittedColumns = array(
        'title',
        'content',
        'site_id',
        'active',
        'layout',
        'show_page_title'
    );

    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->show_page_title = 1;
    }
}
