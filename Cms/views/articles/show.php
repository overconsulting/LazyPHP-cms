<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo $params['pageTitle']; ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<p><?php echo $params['article']->content; ?></p>
			<p>Par <?php echo $params['article']->user->firstname ; ?> <?php echo $params['article']->user->lastname; ?></p>
		</div>
	</div>
</div>
