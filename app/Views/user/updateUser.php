<?php $this->layout('layout', ['title' => 'Modifier vos informations']) ?>

<?php $this->start('main_content') ?>

<!-- formulaire changement à remplir pour changer coordonées user -->
<p class="updateInfoTitle"> Modifier mon compte. <p>
<?php if(isset($success) && $success == true): ?>
	<div class="alert alert-success">
		<p>Tout est ok</p>
	</div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">
		<?= implode('<br>', $errors); ?>
	</div>
<?php endif; ?>

<form method="POST" class="pure-form" enctype="multipart/form-data" id="updateInfos">
	<div class="form-group">
		<label for="ident">Pseudo :</label>
		<input type="text" id="ident" name="username" value="<?php echo $w_user['username']; ?>">
	</div>
<hr>
	<div class="form-group">
		<label for="ident">Prénom :</label>
		<input type="text" id="ident" name="firstname" value="<?php echo $w_user['firstname']; ?>">
	</div>
<hr>
	<div class="form-group">
		<label for="ident">Nom de famille :</label>
		<input type="text" id="ident" name="lastname" value="<?php echo $w_user['lastname']; ?>">
	</div>
<hr>
	<div class="form-group">
		<label for="exampleInputFile">Changer mon image :</label>
		<input name="avatar" type="file" id="img1">
		<br>
		<input type="text" value="<?php echo $w_user['url']; ?>" type="text" name="url"/>
	</div>
<hr>
	<div class="form-goup">
		<label for="passwd">Mot de passe :</label>
		<input type="password" name="password" placeholder="votre mot de passe">
	</div>
<hr>
	<div class="form-goup">
		<label for="password_confirm">Confirmez votre mot de passe :</label>
		<input type="password" id="password" name="password_confirm" placeholder="Confirmer votre mot de passe">
	</div>
<hr>

	<button type="submit" class="btn btn-default">Submit</button>
</form>

<!-- a quoi sert cette div infos id="infosUpdate" ??? -->
<div id="infosUpdate"></div>

<?php $this->stop('main_content') ?>
