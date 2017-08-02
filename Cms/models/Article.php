<?php

namespace Cms\models;

use Core\Model;

class Article extends Model
{
    protected $permittedColumns = array(
        'title',
        'content',
        'user_id',
        'site_id',
        'media_id',
        'articlecategory_id',
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
            ),
            'articlecategory' => array(
                'type' => '1',
                'model' => 'Cms\\models\\ArticleCategory',
                'key' => 'articlecategory_id'
            )
        );
    }

    public function getValidations()
    {
        $validations = parent::getValidations();

        $validations = array_merge($validations, array(
            'site_id' => array(
                'type' => 'required',
                'defaultValue' => null
            ),
            'title' => array(
                'type' => 'required',
                'error' => 'Titre obligatoire'
            )
        ));

        return $validations;
    }
}
