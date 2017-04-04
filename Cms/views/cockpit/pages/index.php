<h1 class="page-title"><i class="fa fa-file-text"></i> Pages</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Liste des Pages</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_pages_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
		{% table tables %}
	</div>
</div>
