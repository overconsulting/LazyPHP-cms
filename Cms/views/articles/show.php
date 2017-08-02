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

<h1 class="page-title article-title"><?php echo $title; ?></h1>
<div class="container">
    <div class="row">
        <div class="col-lg-12 article-content">
            <?php echo $article->content; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="article-author">
                Auteur : <span><?php echo $article->user->getFullName(); ?></span>
            </div>
        </div>
    </div>
</div>
