<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>

<div class="container">
	<div class="msg-admin">
		<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>
		<h2><i class="fa fa-comments-o" aria-hidden="true"></i> Liste des messages(contact) :</h2>
		<hr> 

		<?php if(isset($contact)): ?>
			<?php foreach ($contact as $contacts): ?>
				<?php if($contacts['is_read'] == 'unread') : ?>
					<div class="msg-not-read">
						<strong> Par </strong>: <?= $contacts['name']; ?> (<?=$contacts['email'] ?>)<br>
						<strong>  L'objet de la demande : </strong><?=$contacts['object'] ?> <strong><?=$contacts['is_read'] ?></strong><br>
						<strong>  Contenus :</strong> <?=$contacts['content'] ?><br>
						<strong>  Ajouté le :</strong> <?=$contacts['date_add'] ?> <br>
						<a href="<?= $this->url('admin_checkContact', ['id' => $contacts['id']]); ?>">Marquer comme lu</a>
						<!-- <a href="#" data-msg="<?= $contacts['id']; ?>" class="mark-read">Marquer comme lu</a> -->

					</div>
					<hr>

				<?php elseif($contacts['is_read'] == 'read') : ?>
					<div class="msg-read">
						<strong> Par </strong>: <?= $contacts['name']; ?> (<?=$contacts['email'] ?>)<br>
						<strong>  L'objet de la demande : </strong><?=$contacts['object'] ?> <strong><?=$contacts['is_read'] ?></strong><br>
						<strong>  Contenus :</strong> <?=$contacts['content'] ?><br>
						<strong>  Ajouté le :</strong> <?=$contacts['date_add'] ?> <br>

					</div>
					<hr>
				<?php endif; ?>
			<?php endforeach; ?>

		<?php else: ?>
			<p>
				Aucun message ...
			</p>
		<?php endif; ?>
	</div>
</div>

<?php $this->stop('main_content') ?>

<!-- Ajoute un javascript pour cette page seulement -->
<?php $this->start('js') ?>
	<script>
		$('.msg-read').click(function() {

			var thisMsg = $(this).attr('data-msg');
			$.ajax({
				type: 'POST',
				data: 'idMsg=' + thisMsg,
				dataType: 'json',
				url:
			})
		})
	</script>
<?php $this->stop('js') ?>
