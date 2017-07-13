<h1 class="page-title">{{ titlePage }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles_new" type="success" size="sm" icon="plus" %}
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
                    <th width="5%">A la une</th>
                    <th>Titre</th>
                    <th width="10%">Status</th>
                    <th width="10%">Auteur</th>
					<th width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($params['articles'] as $article) {

    if ($article->media->image != null) {
        if ($article->media->image->url != '') {
            $thumbnail = '<img src="'.$article->media->image->url.'" width="25" height="25" />';
        }
    } else {
        $thumbnail = '';
    }

    if ($article->active == 1) {
        $label = '<span class="label label-success">Activé</span>';
    } else {
        $label = '<span class="label label-danger">Désactivé</span>';
    }

    echo
        '<tr>'.
            '<td>'.$article->id.'</td>'.
            '<td>'.$thumbnail.'</td>'.
            '<td>'.$article->title.'</td>'.
            '<td>'.$label.'</td>'.
            '<td>'.$article->user->getFullName().'</td>'.
            '<td>';?>
    {% button url="cockpit_cms_articles_show_<?php echo $article->id; ?>" type="primary" size="sm" icon="eye" %}
    {% button url="cockpit_cms_articles_edit_<?php echo $article->id; ?>" type="info" size="sm" icon="pencil" %}
    {% button url="cockpit_cms_articles_delete_<?php echo $article->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet article?" %}
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
