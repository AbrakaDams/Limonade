<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>
<h2><i class="fa fa-comments-o" aria-hidden="true"></i> Liste des messages(contact) :</h2>
<hr>
<?php if(isset($contact) && $contact[0]['is_read'] == 'read'): ?>
	<?php foreach ($contact as $contacts): ?>
		<p>
			<strong> Par </strong>: <?= $contacts['name']; ?> (<?=$contacts['email'] ?>)<br>
			<strong>  L'objet de la demande : </strong><?=$contacts['object'] ?> <strong><?=$contacts['is_read'] ?></strong><br>
			<strong>  Contenus :</strong> <?=$contacts['content'] ?><br>
			<strong>  Ajouté le :</strong> <?=$contacts['date_add'] ?> <br>
			<a href="<?= $this->url('admin_checkContact', ['id' => $contacts['id']]); ?>">Ban</a>
		</p>
		<hr>
	<?php endforeach; ?>
<?php elseif(isset($contact) && $contact[0]['is_read'] == 'unread'): ?>
		<?php foreach ($contact as $contacts): ?>
			<p>
				<strong> Par </strong>: <?= $contacts['name']; ?> (<?=$contacts['email'] ?>)<br>
				<strong>  L'objet de la demande : </strong><?=$contacts['object'] ?> <strong><?=$contacts['is_read'] ?></strong><br>
				<strong>  Contenus :</strong> <?=$contacts['content'] ?><br>
				<strong>  Ajouté le :</strong> <?=$contacts['date_add'] ?> <br>
				<a href="<?= $this->url('admin_checkContact', ['id' => $contacts['id']]); ?>">Ban</a>
			</p>
			<hr>
		<?php endforeach; ?>
<?php else: ?>
	<p>
		Aucun message ...
	</p>
<?php endif; ?>
<?php $this->stop('main_content') ?>
