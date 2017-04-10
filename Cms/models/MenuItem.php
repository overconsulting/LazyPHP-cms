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
        'active'
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

    /*public static function getOptions()
    {
        $options = array(
            0 => array(
                'value' => '',
                'label' => '---'
            )
        );

        $itemsMenus = self::getFlat();

        foreach ($itemsMenus as $item) {
            $options[$item->id] = array(
                'value' => $item->id,
                'label' => str_repeat('&nbsp;', $item->level * 8).$item->label
            );
        }

        return $options;
    }*/
}
