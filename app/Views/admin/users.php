<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<a href="<?= $this->url('admin_admin'); ?>">Retour à l'accueil Admin</a>
<h2>Liste des utilisateurs :</h2>

<?php foreach ($users as $user): ?>
	<?php if($user['status'] == 'default'): ?>
		<a href="<?= $this->url('admin_checkUser', ['id' => $user['id']]); ?>">
			<?= $user['username']; ?>
		</a>
		<?= $user['firstname'].' '.$user['lastname'] ?>
		<a href="<?= $this->url('admin_banUser', ['id' => $user['id']]); ?>">Ban</a>
		<br>
	<?php endif; ?>
<?php endforeach; ?>

<h2>Liste des utilisateurs <strong> Bannis </strong> :</h2>
<?php foreach ($users as $user): ?>
	<?php if($user['status'] == 'banned'): ?>
		<a href="<?= $this->url('admin_checkUser', ['id' => $user['id']]); ?>">
			<?= $user['username']; ?>
		</a>
		<?= $user['firstname'].' '.$user['lastname'] ?>
		<a href="<?= $this->url('admin_banUser', ['id' => $user['id']]); ?>">Unban</a>
		<br>
	<?php endif; ?>
<?php endforeach; ?>

<?php $this->stop('main_content') ?>
