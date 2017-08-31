<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_menus_show_<?php echo $menuitem->menu_id; ?>" type="secondary" size="sm" icon="arrow-left" hint="Retour" %}
        </div>
    </div>
    <div class="box-body">
        {% form_open id="formMenu" action="formAction" %}
            {% input_hidden name="menu_id" model="menuitem.menu_id" %}
            {% input_select name="parent" model="menuitem.parent" options="parentOptions" label="Item parent" %}
            {% input_media name="media_id" model="menuitem.media_id" label="Image" mediaType="image" mediaCategory="menuitem" %}
            {% input_text name="label" model="menuitem.label" label="Nom" %}
            {% input_text name="link" model="menuitem.link" label="Link" %}
            {% input_checkbox name="active" model="menuitem.active" label="Actif" %}
            {% input_submit name="submit" value="save" formId="formMenu" class="btn-primary" icon="save" label="Enregistrer" %}
        {% form_close %}
    </div>
</div>
