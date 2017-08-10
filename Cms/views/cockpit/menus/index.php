<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>

        <div class="box-tools pull-right">
            {% button url="cockpit_cms_menus_new" type="succes" size="sm" icon="plus" hint="Ajouter" %}
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
                    <th>Site</th>
                    <th>Label</th>
                    <th>Position</th>
                    <th>Active</th>
					<th width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($params['menus'] as $menu) {
    if ($menu->active == 1) {
        $active = '<span class="label label-success">Activé</span>';
    } else {
        $active = '<span class="label label-danger">Désactivé</span>';
    }

    $position = '';
    foreach ($positionOptions as $option) {
        if ($menu->position == $option['value']) {
            $position = $option['label'];
        }
    }

    echo
        '<tr>'.
            '<td>'.$menu->id.'</td>'.
            '<td>'.$menu->site->label.'</td>'.
            '<td>'.$menu->label.'</td>'.
            '<td>'.$position.'</td>'.
            '<td>'.$active.'</td>'.
            '<td>';?>
                {% button url="cockpit_cms_menus_show_<?php echo $menu->id; ?>" type="primary" size="sm" icon="eye" hint="Voir" %}
                {% button url="cockpit_cms_menus_edit_<?php echo $menu->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
                {% button url="cockpit_cms_menus_delete_<?php echo $menu->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer ce menu ?" hint="Supprimer" %}
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
