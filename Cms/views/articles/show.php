<h1 class="page-header"><?php echo $params['title']; ?></h1>

<p><?php echo $params['article']->content; ?></p>

<p>Par <?php echo $params['article']->user->firstname ; ?> <?php echo $params['article']->user->lastname; ?></p>
