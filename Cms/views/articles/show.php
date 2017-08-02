<?php

if ($article->title != '') {
    echo '<h1 class="page-title article-title">'.$article->title.'</h1>';
}

?>

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
