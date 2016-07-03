<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>

<div class="usersAdmin">
	<a href="<?= $this->url('admin_admin'); ?>" class="btn btn-default">Retour à l'accueil Admin</a>
	<h2><i class="fa fa-users" aria-hidden="true"></i>Liste des utilisateurs :</h2>

	<?php foreach ($users as $user): ?>
		<div class="list-users-admin">
			<?php if($user['status'] == 'default'): ?>
				<a href="<?= $this->url('admin_checkUser', ['id' => $user['id']]); ?>">
					<?= $user['username']; ?>
				</a>
				<?= $user['firstname'].' '.$user['lastname'] ?>
				<a href="<?= $this->url('admin_banUser', ['id' => $user['id']]); ?>">Ban</a>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
	
	<h2>Liste des utilisateurs <strong> Bannis </strong> :</h2>

	<?php foreach ($users as $user): ?>
		<div class="list-users-ban">
			<?php if($user['status'] == 'banned'): ?>
				<a href="<?= $this->url('admin_checkUser', ['id' => $user['id']]); ?>">
					<?= $user['username']; ?>
				</a>
				<?= $user['firstname'].' '.$user['lastname'] ?>
				<a href="<?= $this->url('admin_banUser', ['id' => $user['id']]); ?>">Unban</a>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
<?php $this->stop('main_content') ?>
