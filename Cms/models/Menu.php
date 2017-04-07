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

    public static function getOptions()
    {
        $options = array(
            0 => array(
                'value' => '',
                'label' => '---'
            )
        );

        $menus = self::getFlat();

        foreach ($menus as $menu) {
            $options[$menu->id] = array(
                'value' => $menu->id,
                'label' => str_repeat('&nbsp;', $menu->level * 8).$menu->label
            );
        }

        return $options;
    }
}
