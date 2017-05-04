<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_menus_index'); ?>" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a>
            <a href="<?php echo url('cockpit_cms_menu_'.$params['menu']->id.'_menusitems_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th width="10%">Item</th>
                    <th width="80%">Label</th>
                    <th>Status</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($params['items'] as $item) {
    echo '<tr>';
    echo '<td>'.$item->id.'</td>';
    
    if ($item->media->image != null) {
        if ($item->media->image->url != '') {
            $thumbnail = '<img src="'.$item->media->image->url.'" width="25" height="25" />';
        }
    } else {
        $thumbnail = '';
    }

    echo '<td>'.$thumbnail.'</td>';
    

    echo '<td>';
    echo '<span style="font-family: monospace;">'.str_repeat('&nbsp;', $item->level * 4).'|__</span>&nbsp;&nbsp;';
    echo $item->label;
    echo '</td>';
    if ($item->active == 1) {
        $label = '<span class="label label-success">Activé</span>';
    } else {
        $label = '<span class="label label-danger">Désactivé</span>';
    }
    echo '<td>'.$label.'</td>';
    echo '<td>';
    echo '<a href="'.url('cockpit_cms_menu_'.$params['menu']->id.'_menusitems_edit', array('id' => $item->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> ';
    echo '<a href="'.url('cockpit_cms_menu_'.$params['menu']->id.'_menusitems_delete', array('id' => $item->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
            </tbody>
        </table>
    </div>
</div>