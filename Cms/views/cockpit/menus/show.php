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

        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th width="10%">Item</th>
                    <th width="60%">Label</th>
                    <th width="20%">URL</th>
                    <th>Status</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($items as $item) {
    if ($menu->active == 1) {
        $active = '<span class="badge badge-success">Activé</span>';
    } else {
        $active = '<span class="badge badge-danger">Désactivé</span>';
    }

    $image = '';
    $imageUrl = $item->getImageUrl();
    if ($imageUrl != '') {
        $image = '<img src="'.$imageUrl.'" width="25" height="25" />';
    }

    $indent = '<span style="font-family: monospace;">'.str_repeat('&nbsp;', $item->level * 4).'|__</span>&nbsp;&nbsp;';

    echo
        '<tr>'.
            '<td>'.$item->id.'</td>'.
            '<td>'.$image.'</td>'.
            '<td>'.$indent.$item->label.'</td>'.
            '<td>'.$item->link.'</td>'.
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
