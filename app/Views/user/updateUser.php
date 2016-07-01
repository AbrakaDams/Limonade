<?php $this->layout('layout', ['title' => 'Modifier vos informations']) ?>

<?php $this->start('main_content') ?>

<!-- formulaire changement à remplir pour changer coordonées user -->
<h1 class="updateInfoTitle"> Modifier mon compte. </h1>
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

<form method="POST" enctype="multipart/form-data" id="updateInfos">
	<div class="form-group">
		<label for="ident">Pseudo :</label>
		<input class="form-control" type="text" id="ident" name="username" value="<?php echo $w_user['username']; ?>">
	</div>
	<hr>
	<div class="form-group">
		<label for="ident">Prénom :</label>
		<input class="form-control" type="text" id="ident" name="firstname" value="<?php echo $w_user['firstname']; ?>">
	</div>
	<div class="form-group">
		<label for="ident">Nom :</label>
		<input class="form-control" type="text" id="ident" name="lastname" value="<?php echo $w_user['lastname']; ?>">
	</div>
	<hr>
	<div class="form-group">
		<label for="exampleInputFile">Changer mon image :</label>
		<input class="form-control" name="avatar" type="file" id="img1">
		<br>
		<label for="exampleInputFile">Ou changer le lien de mon image :</label><br>
		<input class="form-control" type="text" value="<?php echo $w_user['url']; ?>" type="text" name="url"/>
	</div>
	<hr>
	<div class="form-group">
		<label for="passwd">Mot de passe :</label>
		<input class="form-control" type="password" name="password" placeholder="votre mot de passe">
	</div>
	<div class="form-group">
		<label for="password_confirm">Confirmez votre mot de passe :</label>
		<input class="form-control" type="password" id="password" name="password_confirm" placeholder="Confirmer votre mot de passe">
	</div>
	<hr>
	<button type="submit" class="btn btn-default">Modifier</button>
</form>

<!-- a quoi sert cette div infos id="infosUpdate" ??? -->
<div id="infosUpdate"></div>

<?php $this->stop('main_content') ?>
