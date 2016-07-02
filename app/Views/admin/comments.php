<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>">Retour à l'accueil Admin</a>
<h2>Liste des commentaires :</h2>
<?php foreach ($comments as $comment): ?>
	<b><?= $comment['content']; ?></b>
	<a href="<?= $this->url('admin_banUser', ['id' => $user['id']]); ?>">Supprimer ce commentaire</a>
	<br>
	Ajouté le :
	<?= $comment['date_add'];?>
	Dans : 
	<a href="<?= $this->url('event_showEvent', ['id' => $comment['id_event']]); ?>">
		<?= $comment['title']?>
	</a>
	Par : 
	<a href="<?= $this->url('admin_checkUser', ['id' => $comment['id_user']]); ?>">
		<?= $comment['username'];?>
	</a>

	<br><br>

<?php endforeach; ?>



<?php $this->stop('main_content') ?>