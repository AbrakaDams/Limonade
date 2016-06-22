<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>
	<h2>My event</h2>

	<?php var_dump($thisEvent); ?>
<?php $this->stop('main_content') ?>
