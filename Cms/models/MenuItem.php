<?php

namespace Cms\models;

use Core\Model;

class MenuItem extends Model
{
    protected $permittedColumns = array(
        'menu_id',
        'parent',
        'position',
        'label',
        'link',
        'media_id',
        'target',
        'active'
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

    /**
     * Get image
     *
     * @return string
     */
    public function getImageUrl()
    {
        if ($this->media !== null) {
            return $this->media->getUrl();
        } else {
            return '';
        }
    }
}
