<?php

namespace Cms\models;

use System\Model;

class Article extends Model
{
    protected $permittedColumns = array(
        'title',
        'content',
        'user_id',
        'site_id',
        'media_id',
        'active'
    );
    
    /**
     * Get list of associed table(s)
     *
     * @return mixed
     */
    public function getAssociations()
    {
        return array(
            'user' => array(
                'type' => '1',
                'model' => 'Auth\\models\\User',
                'key' => 'user_id'
            ),
            'media' => array(
                'type' => '1',
                'model' => 'Media\\models\\Media',
                'key' => 'media_id'
            )
        );
    }
}
