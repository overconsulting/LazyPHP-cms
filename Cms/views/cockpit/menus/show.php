<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Gestion du Menu</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo system\Router::url('cockpit_cms_menus_index'); ?>" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th width="80%">Label</th>
                    <th>Status</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($params['menu']->menuitems as $item) {
    echo '<tr>';
    echo '<td>'.$item->id.'</td>';
    echo '<td>'.$item->label.'</td>';
    if ($item->active == 1) {
        $label = '<span class="label label-success">Activé</span>';
    } else {
        $label = '<span class="label label-danger">Désactivé</span>';
    }
    echo '<td>'.$label.'</td>';
    
    echo '<td>';
    echo '<a href="'.System\Router::url('cockpit_cms_menus_show', array('id' => $item->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> ';
    echo '<a href="'.System\Router::url('cockpit_cms_menus_edit', array('id' => $item->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> ';
    echo '<a href="'.System\Router::url('cockpit_cms_menus_delete', array('id' => $item->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
            </tbody>
        </table>
    </div>
</div>