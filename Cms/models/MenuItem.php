<?php

namespace Cms\models;

use Core\Model;
use Core\Session;

class MenuItem extends Model
{
    protected $permittedColumns = array(
        'menu_id',
        'parent',
        'position',
        'label',
        'link',
        'media_id',
        'new_window',
        'show_label',
        'show_icon',
        'groups',
        'active',
        'connected',
        'notconnected'
    );

    public function setDefaultProperties() {
        parent::setDefaultProperties();

        $this->new_window = 0;
        $this->show_label = 1;
        $this->show_icon = 1;
    }

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

        $groups = $this->groups != '' ? explode(';', $this->groups) : array();
        $current_user = Session::get('current_user');

        if (Session::get('current_user') == null) {
            if ($this->connected == 0 || $this->notconnected == 1) {
                $show = true;
            } else {
                $show = false;
            }
        } else {
            if ($this->connected == 1 || $this->notconnected == 0) {
                $show = true;
            } else {
                $show = false;
            }
        }

        if (empty($groups) || ($current_user !== null && in_array($current_user->group_id, $groups) || $show)) {
            $icon = '';
            if ($this->show_icon == 1) {
                $url = $this->media !== null ? $this->media->getUrl() : '';
                if ($url != '') {
                    $icon = '<img class="menu-item-icon" src="'.$url.'" />';
                }
            }

            $label = $this->show_label == 1 ? '<div class="menu-item-label">'.$this->label.'</div>' : '';

            $target  = $this->new_window == 1 ? ' target="_blank"' : '';

            $where = 'parent = '.$this->id.' and active = 1';
            $order = 'position';
            $items = MenuItem::findAll($where, $order);

            if (!empty($items)) {
                $html .=
                    '<li class="nav-item dropdown menu-item">'.
                        '<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.
                            $icon.$label.
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
                            '<a class="nav-link" href="'.$this->link.'"'.$target.'>'.$icon.$label.'</a>'.
                        '</li>';
                } else {
                    $html .=
                        '<a class="dropdown-item menu-item" href="'.$this->link.'"'.$target.'>'.$icon.$label.'</a>';
                }
            }
        }

        return $html;
    }
}
