<h1 class="page-title">{{ pageTitle }}</h1>
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="secondary" icon="arrow-left" size="sm" hinr="Retour" %}
<?php if ($this->checkPermission('cms_article_publish') && $article->status != 'published'): ?>
            {% button url="cockpit_cms_articles_publish_<?php echo $article->id ?>" type="success" icon="share" content="Publier" %}
<?php endif; ?>
        </div>
    </div>
    <div class="box-body">
        {% form_open id="formArticle" action="formAction" %}
<?php if ($selectSite): ?>
           {% input_select name="site_id" model="faq.site_id" label="Site" options="siteOptions" %}
<?php endif; ?>
            {% input_select name="user_id" model="article.user_id" options="userOptions" label="Auteur" %}
            {% input_select name="articlecategory_id" model="article.articlecategory_id" options="articleCategoryOptions" label="Catégorie" %}
            {% input_text name="title" model="article.title" label="Titre" %}
            {% input_textarea name="content" model="article.content" label="Contenu" rows="10" class="tinymce" %}
            {% input_media name="media_id" model="article.media_id" label="Image" mediaType="image" mediaCategory="article" %}
            {% input_checkbox name="active" model="article.active" label="Actif" %}
<?php if ($selectStatus): ?>
        {% input_select name="status" model="article.status" options="statusOptions" label="Etat" %}
<?php endif; ?>
            {% input_submit name="submit" value="save" formId="formArticle" class="btn-primary" icon="save" label="Enregistrer" %}
        {% form_close %}
<?php if (!$selectStatus): ?>
        <span>Status : </span><span class="badge badge-<?php echo $statusOptions[$article->status]['badge']; ?>"><?php echo $statusOptions[$article->status]['label']; ?></span>
<?php endif; ?>
	</div>
</div>
