<h1 class="page-title"><i class="fa fa-file-text"></i> Pages</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Liste des Pages</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_pages_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>Titre</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($params['pages'] as $page) {
    ?>
    <tr>
        <td><?php echo $page->id ?></td>
        <td><?php echo $page->title ?></td>
        <td>
            {% button url="cockpit_cms_pages_edit_<?php echo $page->id ?>" type="primary" size="xs" icon="pencil" content="" %}
            {% button url="cockpit_cms_pages_delete_<?php echo $page->id ?>" type="danger" size="xs" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cette page ?" %}
        </td>
    </tr>
    <?php
}
?>
            </tbody>
        </table>
    </div>
</div>
