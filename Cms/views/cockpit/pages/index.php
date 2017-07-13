<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-purple">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_pages_new'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>Titre</th>
                    <th>Layout</th>
                    <th width="10%">Status</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($params['pages'] as $page) {
    ?>
    <tr>
        <td><?php echo $page->id; ?></td>
        <td><?php echo $page->title; ?></td>
        <td><?php echo $page->layout; ?></td>
        <?php
        if ($page->active == 1) {
            $label = '<span class="label label-success">Activé</span>';
        } else {
            $label = '<span class="label label-danger">Désactivé</span>';
        }
        echo '<td>'.$label.'</td>';
        ?>
        <td>
            {% button url="cockpit_cms_pages_edit_<?php echo $page->id; ?>" type="info" size="sm" icon="pencil" content="" %}
            {% button url="cockpit_cms_pages_delete_<?php echo $page->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cette page?" %}
        </td>
    </tr>
    <?php
}
?>
            </tbody>
        </table>
    </div>
</div>
