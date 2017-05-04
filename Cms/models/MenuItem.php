<?php

namespace Cms\models;

use System\Model;

class MenuItem extends Model
{
    protected $permittedColumns = array(
        'parent',
        'label',
        'link',
        'position',
        'active',
        'menu_id',
        'media_id'
    );

    public function getAssociations()
    {
        return array(
            'menu' => array(
                'type' => '1',
                'model' => 'Cms\\models\\Menu',
                'key' => 'menu_id'
            ),
            'media' => array(
                'type' => '1',
                'model' => 'Media\\models\\Media',
                'key' => 'media_id'
            )
        );
    }
}
