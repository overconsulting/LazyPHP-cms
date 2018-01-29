<?php

namespace Cms\models;

use Core\Model;

class Article extends Model
{
    protected $permittedColumns = array(
        'site_id',
        'article_id',
        'user_id',
        'title',
        'content',
        'media_id',
        'articlecategory_id',
        'status',
        'hooked',
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
            'site' => array(
                'type' => '1',
                'model' => 'Core\\models\\Site',
                'key' => 'site_id'
            ),
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
            ),
            'revisions' => array(
                'type' => '*',
                'model' => 'Cms\\models\\Article',
                'key' => 'article_id',
                'order' => 'id desc'
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

    public static function getAll($where = '')
    {
        if ($where != '' and $status='published' ) {
            $where .= ' and ';
        }
        $where .= 'article_id is null';
        return self::findAll($where, 'updated_at desc');
    }

    public static function getLastRevision($article_id, $status = '')
    {
        $whereStatus = $status != '' ? ' and status = \''.$status.'\'' : '';
        $articleClass = self::loadModel('Article');
        $articles = $articleClass::findAll(
            '(article_id = '.$article_id.')'.$whereStatus.' and active = 1',
            'created_at desc, updated_at desc'
        );

        if (!empty($articles)) {
            return $articles[0];
        } else {
            return null;
        }
    }
}
