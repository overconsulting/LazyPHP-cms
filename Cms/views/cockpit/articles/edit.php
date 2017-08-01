<h1 class="page-title">{{ titlePage }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ titleBox }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="secondary" icon="arrow-left" size="sm" %}
        </div>
    </div>
    <div class="box-body">
        {% form_open id="formArticle" action="formAction" %}
            {% input_select name="user_id" model="article.user_id" options="authorOptions" label="Auteur" %}
            {% input_text name="title" model="article.title" label="Titre" %}
            {% input_media name="media_id" model="article.media_id" label="Image" mediaType="image" mediaCategory="article" %}
            {% input_textarea name="content" model="article.content" label="Contenu" rows="10" %}
            {% input_checkbox name="active" model="article.active" label="Actif" %}
            {% input_submit name="submit" value="save" formId="formArticle" class="btn-primary" icon="save" label="Enregistrer" %}
        {% form_close %}
	</div>
</div>
