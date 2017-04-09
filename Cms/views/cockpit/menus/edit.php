<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Gestion du Menu</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo system\Router::url('cockpit_cms_menus_index'); ?>" class="btn btn-default btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
		{% form_open id="formMenu" action="formAction" class="form-horizontal" %}
		    {% input_select name="parent" model="menu.parent" options="menusOptions" label="Menu parent" %}
		    {% input_text name="label" model="menu.label" label="Nom" %}
		    {% input_text name="link" model="menu.link" label="Link" %}
		    {% input_checkbox name="active" model="menu.active" label="Actif" %}
		    {% input_submit name="submit" value="save" formId="formMenu" class="btn-primary" icon="save" label="Enregistrer" %}
		{% form_close %}
	</div>
</div>