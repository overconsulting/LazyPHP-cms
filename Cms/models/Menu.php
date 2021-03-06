<?php

namespace Cms\models;

use Core\Model;
use Core\Session;
use Cms\models\MenuItem;

class Menu extends Model
{
    protected $permittedColumns = array(
        'label',
        'site_id',
        'position',
        'active'
    );

    public function setDefaultProperties() {
        parent::setDefaultProperties();

        $this->position = 'main';
    }

    public function getAssociations()
    {
        return array(
            'site' => array(
                'type' => '1',
                'model' => 'Core\\models\\Site',
                'key' => 'site_id'
            ),
            'menuitems' => array(
                'type' => '*',
                'model' => 'Cms\\models\\MenuItem',
                'key' => 'menu_id'
            )
        );
    }

    public function getValidations()
    {
        return array_merge(
            parent::getValidations(),
            array(
                'label' => array(
                    'type' => 'required',
                    'error' => 'Nom obligatoire'
                )
            )
        );
    }

    public static function getPositionOptions()
    {
        return array(
            array('label' => 'Principal', 'value' => 'main'),
            array('label' => 'Pied de page 1', 'value' => 'footer1'),
            array('label' => 'Pied de page 2', 'value' => 'footer2')
        );
    }

    /**
     * Get HTML code for the menu
     * @return string
     **/
    public function getHtml()
    {
        $html = '<ul id="menu_'.$this->id.'" class="menu menu-'.$this->position.' navbar-nav">';
        $where = 'menu_id = '.$this->id.' AND parent is null AND active = 1';
        if (Session::get('current_user') == null) {
            $where .= '  AND (notconnected = 1 OR connected = 0)';
        } else {
            $where .= '  AND (connected = 1 OR notconnected = 0)';
        }

        $order = 'position';
        $items = MenuItem::findAll($where, $order);

        if (!empty($items)) {
            foreach($items as $item) {
                $html .= $item->getHtml();
            }
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * Render the menu
     **/
    public function render()
    {
        echo $this->getHtml();
    }
}
