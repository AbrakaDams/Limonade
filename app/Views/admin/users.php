<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<? var_dump($users); ?>
<h2>Liste des utilisateurs :</h2>
<?php foreach ($users as $user): ?>
	<a href="<?= $this->url('admin_checkUser', ['id' => $user['id']]); ?>">
		<?= $user['username']; ?>
	</a>
	<?= $user['firstname'].' '.$user['lastname'] ?>
	<br>

<?php endforeach; ?>


<?php $this->stop('main_content') ?>