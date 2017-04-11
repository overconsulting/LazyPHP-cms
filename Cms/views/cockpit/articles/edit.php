<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Liste des articles</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="default" icon="arrow-left" size="xs" %}
        </div>
    </div>
    <div class="box-body">
{% form_open id="formArticle" action="formAction" class="form-horizontal" %}
    {% input_select name="user_id" model="article.user_id" options="authorOptions" label="Auteur" %}
    {% input_text name="title" model="article.title" label="Titre" %}
    {% input_textarea name="content" model="article.content" label="Contenu" rows="10" %}
    {% input_submit name="submit" value="save" formId="formArticle" class="btn-primary" icon="save" label="Enregistrer" %}
{% form_close %}
	</div>
</div>
