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
            ),
            'menuitems' => array(
                'type' => '*',
                'model' => 'Cms\\models\\MenuItem',
                'key' => 'parent'
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

    /**
     * Get HTML code for the item
     * @return string
     **/
    public function getHtml($level = 0)
    {
        $html = '';

        $url = $this->media !== null ? $this->media->getUrl() : '';
        if ($url != '') {
            $icon = '<img src="'.$url.'" />';
        } else {
            $icon = '';
        }

        $where = 'parent = '.$this->id;
        $order = 'position';
        $items = MenuItem::findAll($where, $order);

        if (!empty($items)) {
            $html .=
                '<li class="nav-item dropdown menu-item">'.
                    '<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.
                        $icon.$this->label.
                    '</a>'.
                    '<div class="dropdown-menu">';
            foreach ($items as $item) {
                $html .= $item->getHtml($level + 1);
            }
            $html .=
                    '</div>'.
                '</li>';
        } else {
            if ($level == 0) {
                $html .= 
                    '<li class="nav-item menu-item">'.
                        '<a class="nav-link" href="'.$this->link.'">'.$icon.$this->label.'</a>'.
                    '</li>';
            } else {
                $html .= 
                    '<a class="dropdown-item menu-item" href="'.$this->link.'">'.$icon.$this->label.'</a>';
            }
        }

        return $html;
    }
}
