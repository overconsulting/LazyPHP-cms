<?php

namespace Cms\models;

use Core\Model;

class Menu extends Model
{
    protected $permittedColumns = array(
        'label',
        'site_id',
        'position',
        'active'
    );

    public function getAssociations()
    {
        return array(
            'site' => array(
                'type' => '1',
                'model' => 'MultiSite\\models\\Site',
                'key' => 'site_id'
            ),
            'menuitems' => array(
                'type' => '*',
                'model' => 'Cms\\models\\MenuItem',
                'key' => 'menu_id'
            )
        );
    }

    public static function getPositionOptions()
    {
        return array(
            array('label' => 'Principal', 'value' => 'main'),
            array('label' => 'Pied de page 1', 'value' => 'footer1'),
            array('label' => 'Pied de page 2', 'value' => 'footer2')
        );
    }
}
