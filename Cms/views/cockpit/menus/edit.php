<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_menus_index" type="secondary" size="sm" icon="arrow-left" hint="Retour" %}
        </div>
    </div>
    <div class="box-body">
        {% form_open id="formMenu" action="formAction" %}
            {% input_text name="label" model="menu.label" label="Nom" %}
            {% input_select name="position" model="menu.position" options="positionOptions" label="Position" %}
            {% input_checkbox name="active" model="menu.active" label="Actif" %}
            {% input_submit name="submit" value="save" formId="formMenu" class="btn-primary" icon="save" label="Enregistrer" %}
        {% form_close %}
    </div>
</div>
