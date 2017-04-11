<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Liste des articles</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles_new" type="success" size="xs" icon="plus" %}
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
                    <th>Auteur</th>
                    <th>Titre</th>
                    <th>Contenu</th>
					<th width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($params['articles'] as $article) {
    echo
        '<tr>'.
            '<td>'.$article->id.'</td>'.
            '<td>'.$article->user->getFullName().'</td>'.
            '<td>'.$article->title.'</td>'.
            '<td>'.$article->content.'</td>'.
            '<td>';?>
    {% button new_window="1" url="articles_show_<?php echo $article->id; ?>" type="primary" size="xs" icon="eye" %}
    {% button url="cockpit_cms_articles_show_<?php echo $article->id; ?>" type="default" size="xs" icon="eye" %}
    {% button url="cockpit_cms_articles_edit_<?php echo $article->id; ?>" type="info" size="xs" icon="pencil" %}
    {% button url="cockpit_cms_articles_delete_<?php echo $article->id; ?>" type="danger" size="xs" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet article?" %}
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