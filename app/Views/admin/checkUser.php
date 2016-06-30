<?php $this->layout('layoutAdmin', ['title' => 'Modifier vos informations']) ?>

<?php $this->start('main_content') ?>


<!-- Formulaire de modification user ADMIN -->
<?php if(isset($success) && $success == true): ?>
	<div class="alert alert-success">
		<p>Tout est bon, votre utilisateur a bien été modifié.</p>
	</div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">
		<p>Il y a des erreurs</p>
		<?= implode('<br>', $errors); ?>
	</div>
<?php endif; ?>

<form method="POST" class="pure-form" enctype="multipart/form-data" id="updateInfos">
	<h1 class="center">Modifier un utilisateur</h1>
	<div class="form-group">
		<label for="ident">Pseudo</label>
		<input type="text" id="ident" name="username" value="<?php echo $w_user['username']; ?>">
	</div>
	<div class="form-group">
		<label for="ident">Prénom</label>
		<input type="text" id="ident" name="firstname" value="<?php echo $w_user['firstname']; ?>">
	</div>

	<div class="form-group">
		<label for="ident">Nom de famille</label>
		<input type="text" id="ident" name="lastname" value="<?php echo $w_user['lastname']; ?>">
	</div>

	<div class="form-group">
		<label for="exampleInputFile"> Charger mon image </label>
		<input name="avatar" type="file" id="img1">
		<p class="help-block"> mon avatar <br></p>
		<input type="text" placeholder="www.mon_image.com" type="text" name="url"/>
	</div>
	<button type="submit" class="btn btn-default">Modifier l'utilisateur</button>	
</form>

<div id="userUpdate"></div>

<?php $this->stop('main_content') ?>