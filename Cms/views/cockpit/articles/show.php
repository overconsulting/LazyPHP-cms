<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title"><?php echo $params['article']->title; ?></h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="default" icon="arrow-left" size="xs" %}
        </div>
    </div>
	<div class="box-body">
	<p><?php echo $params['article']->content; ?></p>

	<p>Par <?php echo $params['article']->user->fullname ; ?></p>
</div>
