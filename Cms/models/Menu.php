<?php

namespace Cms\models;

use System\Model;
use System\Query;
use System\Password;

class Menu extends Model
{

    protected $permittedColumns = array(
        'parent',
        'label',
        'link',
        'position',
        'active'
    );

    public static function getTableName()
    {
        return 'menus';
    }

    /**
     * Set default properties values
     */
    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->parent = null;
        $this->position = 0;
        $this->active = 1;
    }
}
