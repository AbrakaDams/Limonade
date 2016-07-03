<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>
<h2><i class="fa fa-comments-o" aria-hidden="true"></i> Liste des messages(contact) :</h2>
<hr>
<?php foreach ($contact as $contact): ?>
	<p> <strong> Par </strong>: <?= $contact['name']; ?> (<?=$contact['email'] ?>)<br>
		<strong>  L'objet de la demande : </strong><?=$contact['object'] ?><br>
		<strong>  Contenus :</strong> <?=$contact['content'] ?><br>
		<strong>  Ajouté le :</strong> <?=$contact['date_add'] ?> <br>
	</p>
	<hr>
<?php endforeach; ?>



<?php $this->stop('main_content') ?>
