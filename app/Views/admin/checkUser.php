<?php $this->layout('layoutAdmin', ['title' => 'Modifier les informations d\'un utilisateur']) ?>

<?php $this->start('main_content') ?>
<!-- Formulaire de modification user ADMIN -->
<?php if(isset($success) && $success == true): ?>
	<div class="alert alert-success">
		<p>Tout est bon, votre utilisateur a bien été modifié.</p>
	</div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">		
		<?= implode('<br>', $errors); ?>
	</div>
<?php endif; ?>

<form id="update" method="POST" class="pure-form" enctype="multipart/form-data">
	<h1 class="center">Modifier un utilisateur</h1>
	<div class="form-group">
		<label for="ident">Pseudo </label>
		<input type="text" name="username" id="username" value="<?php echo $userData['username']; ?>">
	</div>
	<div class="form-group">
		<label for="ident">Prénom </label>
		<input type="text" name="firstname" id="firstname" value="<?php echo $userData['firstname']; ?>">
	</div>
	<div class="form-group">
		<label for="ident">Nom de famille </label>
		<input type="text" name="lastname" id="lastname" value="<?php echo $userData['lastname']; ?>">
	</div>
	<div class="form-group">
		<label for="exampleInputFile"> Charger mon image </label>
		<input name="avatar" type="file" id="img1">
		<p class="help-block"> Mon avatar <br></p>
		<input id="url" type="text" placeholder="www.mon_image.com" type="text" name="url"/>
	</div>
	<button type="submit" class="btn btn-default">Modifier l'utilisateur</button>
	<?php if($userData['status'] == 'banned'): ?>
		<a href="<?= $this->url('admin_banUser', ['id' => $userData['id']]); ?>" class="btn btn-danger" role="button">Unban</a>
	<?php else : ?>
		<a href="<?= $this->url('admin_banUser', ['id' => $userData['id']]); ?>" class="btn btn-danger" role="button">Ban</a>
	<?php endif; ?>
</form>

<div id="userUpdate"></div>


<?php $this->stop('main_content') ?>
<?php $this->start('js'); ?>

<?php $this->stop('js'); ?>