<?php

namespace Cms\models;

use System\Model;

class Article extends Model
{
    protected $permittedColumns = array('title', 'content', 'user_id');
    
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
                'model' => 'app\\models\\User',
                'key' => 'user_id'
            )
        );
    }
}