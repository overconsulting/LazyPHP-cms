<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_menus_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
					<th>Label</th>
                    <th>Active</th>
					<th width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($params['menus'] as $menu) {
    echo '<tr>';
    echo '<td>'.$menu->id.'</td>';
    if ($menu->principal == 1) {
        echo '<td><b>'.$menu->label.'</b></td>';
    } else {
        echo '<td>'.$menu->label.'</td>';
    }
    
    if ($menu->active == 1) {
        $label = '<span class="label label-success">Activé</span>';
    } else {
        $label = '<span class="label label-danger">Désactivé</span>';
    }
    echo '<td>'.$label.'</td>';
    echo '<td>';
    echo '<a href="'.Core\Router::url('cockpit_cms_menus_show', array('id' => $menu->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> ';
    echo '<a href="'.Core\Router::url('cockpit_cms_menus_edit', array('id' => $menu->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> ';
    echo '<a href="'.Core\Router::url('cockpit_cms_menus_delete', array('id' => $menu->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
			</tbody>
		</table>
	</div>
</div>