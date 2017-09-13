<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articlecategories_new" type="success" icon="plus" size="sm" hint="Ajouter" %}
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th>Code</th>
                    <th>Nom</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach ($params['articleCategories'] as $articleCategory) {
    echo
        '<tr>'.
            '<td>'.$articleCategory->id.'</td>'.
            '<td>'.$articleCategory->code.'</td>'.
            '<td>'.$articleCategory->label.'</td>'.
            '<td>';?>
                {% button url="cockpit_cms_articlecategories_edit_<?php echo $articleCategory->id ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
                {% button url="cockpit_cms_articlecategories_delete_<?php echo $articleCategory->id ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cette catégorie d'article ?" hint="Supprimer" %}
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