<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articlecategories" type="secondary" size="sm" icon="arrow-left" content="" %}
        </div>
    </div>
    <div class="box-body">
        {% form_open id="formArticleCategory" action="formAction" %}
<?php if ($selectSite): ?>
            {% input_select name="site_id" model="articleCategory.site_id" label="Site" options="siteOptions" %}
<?php endif; ?>
            {% input_text name="code" model="articleCategory.code" label="Code" %}
            {% input_text name="label" model="articleCategory.label" label="Nom" %}
            {% input_submit name="submit" value="save" formId="formArticleCategory" class="btn-primary" icon="save" label="Enregistrer" %}
        {% form_close %}
    </div>
</div>
