<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles_new" type="success" size="sm" icon="plus" hint="Ajouter" %}
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th width="10%">#</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Auteur</th>
                    <th>Etat</th>
                    <th>Révisions</th>
					<th style="width: 12rem;">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php

foreach ($params['articles'] as $article) {
    if ($article->articlecategory_id != null) {
        $category = $article->articlecategory->label;
    } else {
        $category = '';
    }

    $status = '<span class="badge badge-'.$statusOptions[$article->status]['badge'].'">'.$statusOptions[$article->status]['label'].'</span>';

    if ($article->active == 1) {
        $active = '<span class="badge badge-success">Activé</span>';
    } else {
        $active = '<span class="badge badge-danger">Désactivé</span>';
    }

    echo
        '<tr>'.
            '<td>'.$article->id.'</td>'.
            '<td>'.$article->title.'</td>'.
            '<td>'.$category.'</td>'.
            '<td>'.$article->user->getFullName().'</td>'.
            '<td>'.$status.' '.$active.'</td>'.
            '<td>'.count($article->revisions).'</td>'.
            '<td>';?>
                {% button url="cockpit_cms_articles_show_<?php echo $article->id; ?>" type="primary" size="sm" icon="eye" hint="Voir" %}
<?php if ($this->checkPermission('cms_page_publish') && ($article->status == 'draft' || $article->status == 'pending')): ?>
                {% button url="cockpit_cms_articles_setstatus_<?php echo $article->id ?>_published" type="success" size="sm" icon="share" hint="Publier" %}
<?php endif; ?>
<?php if ($this->checkPermission('cms_page_write') && $article->status == 'draft'): ?>
                {% button url="cockpit_cms_articles_setstatus_<?php echo $article->id ?>_pending" type="warning" size="sm" icon="flag-o" hint="À valider" %}
<?php endif; ?>
                {% button url="cockpit_cms_articles_edit_<?php echo $article->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
<?php if ($article->status != 'published'): ?>
                {% button url="cockpit_cms_articles_delete_<?php echo $article->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet article ?" hint="Supprimer" %}
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
