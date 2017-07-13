<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo url('cockpit_cms_menus_index'); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="box-body">
		{% form_open id="formMenu" action="formAction" class="form-horizontal" %}
		    {% input_text name="label" model="menu.label" label="Nom" %}
            {% input_checkbox name="principal" model="menu.principal" label="Principal" %}
		    {% input_checkbox name="active" model="menu.active" label="Actif" %}
		    {% input_submit name="submit" value="save" formId="formMenu" class="btn-primary" icon="save" label="Enregistrer" %}
		{% form_close %}
	</div>
</div>
