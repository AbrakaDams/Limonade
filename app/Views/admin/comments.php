<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>
<h2><i class="fa fa-commenting-o" aria-hidden="true"></i>Liste des commentaires :</h2>

<?php if(isset($comments) && !empty($comments)): ?>
	<?php foreach ($comments as $comment): ?>
		<b><?= $comment['content']; ?></b>
		<a href="<?= $this->url('admin_supprComment', ['id' => $comment['id']]); ?>">Supprimer ce commentaire</a>
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
<?php else: ?>
	<p>
		<strong> Pas de commentaires ...&nbsp; :'( </strong>
	</p>
<?php endif; ?>



<?php $this->stop('main_content') ?>
