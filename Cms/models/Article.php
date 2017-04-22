<?php

namespace Cms\models;

use System\Model;

class Article extends Model
{
    protected $permittedColumns = array(
        'title',
        'content',
        'user_id',
        'site_id'
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
            )
        );
    }
}
