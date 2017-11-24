<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>

        <div class="box-tools pull-right">
            {% button url="cockpit_cms_menus_index" type="secondary" size="sm" icon="arrow-left" hint="Retour" %}
            {% button url="cockpit_cms_menu_<?php echo $menu->id; ?>_menusitems_new" type="success" size="sm" icon="plus" hint="Ajouter un élément au menu" %}
        </div>
    </div>
    <div class="box-body">

        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Libellé</th>
                    <th>Icone</th>
                    <th>URL</th>
                    <th>Afficher libellé</th>
                    <th>Afficher icone</th>
                    <th>Visible pour?</th>
                    <th>Actif</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($items as $item) {
    if ($item->active == 1) {
        $active = '<span class="badge badge-success">Activé</span>';
    } else {
        $active = '<span class="badge badge-danger">Désactivé</span>';
    }

    if ($item->show_label == 1) {
        $showLabel = '<i class="fa fa-check text-success"></i>';
    } else {
        $showLabel = '<i class="fa fa-remove text-danger"></i>';
    }

    if ($item->show_icon == 1) {
        $showIcon = '<i class="fa fa-check text-success"></i>';
    } else {
        $showIcon = '<i class="fa fa-remove text-danger"></i>';
    }

    $icon = '';
    $url = $item->media != null ? $item->media->getUrl() : '';
    if ($url!= '') {
        $icon = '<img src="'.$url.'" width="25" height="25" />';
    }

    $indent = '<span style="font-family: monospace;">'.str_repeat('&nbsp;', $item->level * 4).'|__</span>&nbsp;&nbsp;';

    if ($item->groups == '') {
        $groups = '<span class="badge badge-success">Tout le monde</span>&nbsp;';;
    } else {
        $groups = '';
        $itemGroups = explode(';', $item->groups);
        foreach ($groupOptions as $groupOption) {
            if (in_array($groupOption['value'], $itemGroups)) {
                $groups .= '<span class="badge badge-warning">'.$groupOption['label'].'</span>&nbsp;';
            }
        }
        if (count($itemGroups) == count($groupOptions)) {
            $groups = '<span class="badge badge-success">Tout le monde</span>&nbsp;';;
        }
    }

    echo
        '<tr>'.
            '<td>'.$item->id.'</td>'.
            '<td>'.$indent.$item->label.'</td>'.
            '<td>'.$icon.'</td>'.
            '<td>'.$item->link.'</td>'.
            '<td>'.$showLabel.'</td>'.
            '<td>'.$showIcon.'</td>'.
            '<td>'.$groups.'</td>'.
            '<td>'.$active.'</td>'.
            '<td>';?>
                {% button url="cockpit_cms_menu_<?php echo $menu->id; ?>_menusitems_edit_<?php echo $item->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
                {% button url="cockpit_cms_menu_<?php echo $menu->id; ?>_menusitems_delete_<?php echo $item->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet élément du menu ?" hint="Supprimer" %}
<?php
    echo
            '</td>'.
        '</tr>';
}
?>
            </tbody>
        </table>
    </div>
</div>
