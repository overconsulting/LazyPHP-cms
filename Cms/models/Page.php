<?php

namespace Cms\models;

use Core\Model;

class Page extends Model
{
    protected $permittedColumns = array(
        'site_id',
        'page_id',
        'user_id',
        'title',
        'content',
        'show_page_title',
        'layout',
        'status',
        'meta_description',
        'meta_keywords',
        'active'
    );

    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->show_page_title = 1;
    }

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
            'revisions' => array(
                'type' => '*',
                'model' => 'Cms\\models\\Page',
                'key' => 'page_id',
                'order' => 'id desc'
            )
        );
    }

    public static function getAll($where = '')
    {
        if ($where != '') {
            $where .= ' and ';
        }
        $where .= 'page_id is null';
        return self::findAll($where, 'updated_at desc');
    }

    public static function getLastRevision($page_id, $status = '')
    {
        $whereStatus = $status != '' ? ' and status = \''.$status.'\'' : '';
        $pageClass = self::loadModel('Page');
        $pages = $pageClass::findAll(
            '(page_id = '.$page_id.')'.$whereStatus.' and active = 1',
            'created_at desc, updated_at desc'
        );

        if (!empty($pages)) {
            return $pages[0];
        } else {
            return null;
        }
    }

    public function getPageOptions($site_id = null)
    {
        if ($site_id != null) {
            $where = 'site_id = '.$site_id;
        } else {
            $where = '';
        }
        
        $pages = self::getAll($where);

        $themeOptions = array();

        foreach ($pages as $key => $value) {
            $themeOptions[$key] = array(
                'value' => "/pages/".$value->id,
                'label' => $value->title
            );
        }
        return $themeOptions;
    }
}
