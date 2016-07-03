<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>

<div class="listAdmin">
	<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>

	<h2><i class="fa fa-calendar-o" aria-hidden="true"></i> Liste des évènements :</h2>

	<?php foreach ($events as $event): ?>
		<div class="liAdmin">
			<a href="<?= $this->url('event_showEvent', ['id' => $event['id']]); ?>">
				<?= $event['title']; ?>
			</a>
			<br>
			<?= $event['category']; ?>
			<br>
			Du <?= $event['date_start'].' au '.$event['date_end'] ?>
			<br>
			<a href="<?= $this->url('admin_checkEvent', ['id' => $event['id']]); ?>">Modifier cet évènement</a>
			<br><hr>
		</div>

	<?php endforeach; ?>
</div>

<?php $this->stop('main_content') ?>
