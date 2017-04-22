<h1 class="page-title">{{ titlePage }}</h1>

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="default" icon="arrow-left" size="xs" %}
            {% button url="cockpit_cms_articles_edit_<?php echo $params['article']->id; ?>" type="info" size="xs" icon="pencil" %}
    		{% button url="cockpit_cms_articles_delete_<?php echo $params['article']->id; ?>" type="danger" size="xs" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet article?" %}
        </div>
    </div>
	<div class="box-body">
    <img src="<?php echo $params['article']->media->image->url; ?>" width="250" />
	<h1><?php echo $params['article']->title; ?></h1>

    <p><?php echo $params['article']->content; ?></p>

	<p>Par <?php echo $params['article']->user->fullname; ?> le <?php echo $params['article']->user->created_at; ?></p>
</div>
