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
                    <th>Dernière modification</th>
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
            '<td>'.$page->formatDatetime($page->updated_at).'</td>'.
            '<td>'.$status.' '.$active.'</td>'.
            '<td>'.count($page->revisions).'</td>'.
            '<td>';?>
<?php if ($this->checkPermission('cms_page_publish') && ($page->status == 'draft' || $page->status == 'pending')): ?>
                {% button url="cockpit_cms_pages_setstatus_<?php echo $page->id ?>_published" type="success" size="sm" icon="share" hint="Publier" %}
<?php endif; ?>
<?php if ($this->checkPermission('cms_page_write') && $page->status == 'draft'): ?>
                {% button url="cockpit_cms_pages_setstatus_<?php echo $page->id ?>_pending" type="warning" size="sm" icon="flag-o" hint="À valider" %}
<?php endif; ?>
                {% button url="cockpit_cms_pages_edit_<?php echo $page->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
<?php if ($page->status != 'published'): ?>
                {% button url="cockpit_cms_pages_delete_<?php echo $page->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cette page ?" hint="Supprimer" %}
<?php endif; ?>

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
