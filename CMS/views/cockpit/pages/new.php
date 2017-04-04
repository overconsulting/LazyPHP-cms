<h1 class="page-title">Créer une page</h1>

<form action="<?php echo url('cockpit_pages_create'); ?>" method="post">
	<?php echo $this->Form->input('titre') ?>
	<?php echo $this->Form->textarea('contenu') ?>
	<?php echo $this->Form->submit('send', 'Créer la page', 'success', 'right') ?>
</form>
