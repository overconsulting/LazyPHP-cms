<?php

namespace Cms\models;

use System\Model;

class Menu extends Model
{
    protected $permittedColumns = array(
        'label',
        'active',
        'principal',
        'site_id'
    );

    public function getAssociations()
    {
        return array(
            'menuitems' => array(
                'type' => '*',
                'model' => 'Cms\\models\\MenuItem',
                'key' => 'menu_id'
            )
        );
    }
}
