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

<section style=" background: url('/assets/img/size_3_devenir-coach-sportif-sur-paris-black.jpg') transparent center center no-repeat; background-size: cover; padding-top: 150px; padding-bottom: 150px; margin-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style=" color: #eeeeee;">
                <h1></h1>
            </div>
        </div>
    </div>
</section>

<section style="background-color: #eeeeee;">
    <div  class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title text-center gray">
                <?php echo $article->title; ?>
                </h1>
            </div>
        </div>
    </div>
</section>

<section >
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
        <div class="row">
                <div class="col-lg-12">
                    <p class="text-right">
                        <a href="/articles" class="btn btn-primary">Retour aux articles</a>
                    </p>
            </div>
        </div>
    </div>
</section>
