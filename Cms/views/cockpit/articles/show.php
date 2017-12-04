<h1 class="page-title">{{ pageTitle }}</h1>

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">{{ boxTitle }}</h3>
        <div class="box-tools pull-right">
            {% button url="cockpit_cms_articles" type="secondary" size="sm" icon="arrow-left" hint="Retour" %}
<?php if ($this->checkPermission('cms_page_publish') && ($article->status == 'draft' || $article->status == 'pending')): ?>
            {% button url="cockpit_cms_articles_setstatus_<?php echo $article->id ?>_published" type="success" size="sm" icon="share" hint="Publier" %}
<?php endif; ?>
<?php if ($this->checkPermission('cms_page_write') && $article->status == 'draft'): ?>
            {% button url="cockpit_cms_articles_setstatus_<?php echo $article->id ?>_pending" type="warning" size="sm" icon="flag-o" hint="À valider" %}
<?php endif; ?>
            {% button url="cockpit_cms_articles_edit_<?php echo $article->id; ?>" type="info" size="sm" icon="pencil" hint="Modifier" %}
<?php if ($article->status != 'published'): ?>
            {% button url="cockpit_cms_articles_delete_<?php echo $article->id; ?>" type="danger" size="sm" icon="trash-o" confirmation="Vous confirmer vouloir supprimer cet article ?" hint="Supprimer" %}
<?php endif; ?>
        </div>
    </div>
    <div class="box-body">
<?php

if ($article->title != '') {
    $title = $article->title;
} else {
    $title = 'Article n° '.$article->id;
}

if ($article->media_id !== null) {
    $media = '<img src="'.$article->media->image->url.'" alt="" class="img-fluid" />';
} else {
    $media = '';
}

?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="article-title">
                        Titre : <strong><?php echo $title; ?></strong>
                        <hr />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="article-author">
                        Auteur : <strong><?php echo $article->user->getFullName(); ?></strong>
                        <hr />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="article-category">
                        Catégorie : <strong><?php echo $article->articlecategory->label; ?></strong>
                        <hr />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 article-content">
                    <?php echo $article->content; ?>
                </div>
            </div>
        </div>

    </div>
</div>
