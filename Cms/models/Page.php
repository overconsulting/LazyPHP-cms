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
        $where = 'page_id is null';
        return self::findAll($where, 'updated_at desc');
    }

    public static function getLastRevision($page_id, $status = '')
    {
        $whereStatus = $status != '' ? ' and status = \''.$status.'\'' : '';
        $pageClass = self::loadModel('page');
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

    public static function getCmsStatusOptions()
    {
        return array(
            'draft' => array('value' => 'draft', 'label' => 'Brouillon', 'badge' => 'warning'),
            'pending' => array('value' => 'pending', 'label' => 'À valider', 'badge' => 'warning'),
            'published' => array('value' => 'published', 'label' => 'Publié', 'badge' => 'success'),
            'tomodify' => array('value' => 'tomodify', 'label' => 'À modifier', 'badge' => 'warning'),
            'deleted' => array('value' => 'deleted', 'label' => 'Supprimé', 'badge' => 'danger'),
        );
    }
}
