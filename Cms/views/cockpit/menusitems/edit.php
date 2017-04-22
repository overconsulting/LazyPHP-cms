<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_menus_show_'.$params["menuitem"]->menu_id); ?>" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="box-body">
	    {% form_open id="formMenu" action="formAction" class="form-horizontal" %}
	    	{% input_select name="menu_id" model="menuitem.menu_id" options="menusOptions" label="Menu" %}
	    	{% input_select name="parent" model="menuitem.parent" options="menusItemsOptions" label="Item parent" %}
	    	{% input_text name="label" model="menuitem.label" label="Nom" %}
		    {% input_text name="link" model="menuitem.link" label="Link" %}
		    {% input_checkbox name="active" model="menuitem.active" label="Actif" %}
		    {% input_submit name="submit" value="save" formId="formMenu" class="btn-primary" icon="save" label="Enregistrer" %}
		{% form_close %}
	</div>
</div>