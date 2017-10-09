<?php

namespace Cms\models;

use Core\Model;

class Menu extends Model
{
    protected $permittedColumns = array(
        'label',
        'site_id',
        'position',
        'active'
    );

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

    public static function getPositionOptions()
    {
        return array(
            array('label' => 'Principal', 'value' => 'main'),
            array('label' => 'Pied de page 1', 'value' => 'footer1'),
            array('label' => 'Pied de page 2', 'value' => 'footer2')
        );
    }

    public function getHtml()
    {
        $html = '<ul id="menu_'.$this->id.'" class="menu menu-'.$this->poistion.' navbar-nav mr-auto">';

        $items = $this->menuitems;
        if (!empty($items)) {
            foreach($items as $item) {
                $html .= 
                    '<li class="nav-item">'.
                        '<a class="nav-link" href="'.$item->link.'">'.$item->label.'</a>'.
                    '</li>';
            }
        }

        $html .= '</ul>';

        return $html;

            /*<?php foreach ($this->mainMenuitems as $menuitem) { ?>
                <li class="nav-item menu-item <?php if ($this->request->url == $menuitem->link) { ?>active<?php } ?>">
                    <a href="<?php echo $menuitem->link; ?>" class="nav-link link px-0 <?php echo mb_strtolower($this->stripAccents(str_replace(' ', '_', trim($menuitem->label)))) ?>">
                        <?php if ($menuitem->media_id != null) { ?>
                            <?php echo '<img src="'.Media\models\Media::findById($menuitem->media_id)->getUrl().'" />'; ?>
                            <br />
                        <?php } ?>
                        <?php echo mb_strtoupper($menuitem->label); ?>
                    </a>
                    <?php if (!empty($menuitem->children)) { ?>
                        <div class="dropdown-menu sub-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($menuitem->children as $child) { ?>
                                    <a class="dropdown-item .col-xl-4" <?php if ($child->target == 1) { ?>target="_blanck"<?php } ?> href="<?php echo $child->link; ?>"><?php echo $child->label ?></a>
                            <?php  } ?>
                        </div>
                    <?php } else { ?>
                    <?php } ?>
                </li>
            <?php } ?>*/
    }
}
