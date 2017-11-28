<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-purple">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_pages_new" type="success" size="sm" icon="plus" hint="Ajouter" %}
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Layout</th>
                    <th>Etat</th>
                    <th>Révisions</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php

foreach ($pages as $page) {
    $status = '<span class="badge badge-'.$statusOptions[$page->status]['badge'].'">'.$statusOptions[$page->status]['label'].'</span>';

    if ($page->active == 1) {
        $active = '<span class="badge badge-success">Activé</span>';
    } else {
        $active = '<span class="badge badge-danger">Désactivé</span>';
    }

    echo
        '<tr>'.
            '<td>'.$page->id.'</td>'.
            '<td>'.$page->title.'</td>'.
            '<td>'.$page->user->getFullName().'</td>'.
            '<td>'.$page->layout.'</td>'.
            '<td>'.$status.' '.$active.'</td>'.
            '<td>'.count($page->revisions).'</td>'.
            '<td>';?>
<?php if ($page->status != 'published'): ?>
                {% button url="cockpit_cms_pages_publish_<?php echo $page->id; ?>" type="success" size="sm" icon="share" hint="Publier" %}
<?php endif; ?>
                {% button url="cockpit_cms_pages_edit_<?php echo $page->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
                {% button url="cockpit_cms_pages_delete_<?php echo $page->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cette page ?" hint="Supprimer" %}
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
