<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>">Retour à l'accueil Admin</a>
<h2>Liste des évènements :</h2>
<?php foreach ($events as $event): ?>
	<a href="<?= $this->url('event_showEvent', ['id' => $event['id']]); ?>">
		<?= $event['title']; ?>
	</a>
	<br>
	<?= $event['category']; ?>
	<br>
	Du
	<?= $event['date_start'].' au '.$event['date_end'] ?>
	<br>
	<a href="<?= $this->url('admin_checkEvent', ['id' => $event['id']]); ?>">Modifier cet évènement</a>
	<br><br>

<?php endforeach; ?>



<?php $this->stop('main_content') ?>