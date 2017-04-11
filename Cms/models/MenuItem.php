<?php

namespace Cms\models;

use System\Model;
use System\Query;

class MenuItem extends Model
{
    protected $permittedColumns = array(
        'parent',
        'label',
        'link',
        'position',
        'active',
        'menu_id'
    );

    public function getAssociations()
    {
        return array(
            'menu' => array(
                'type' => '1',
                'model' => 'Cms\\models\\Menu',
                'key' => 'menu_id'
            )
        );
    }
}
