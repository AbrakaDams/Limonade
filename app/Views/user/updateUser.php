<?php $this->layout('layout', ['title' => 'Modifier vos informations']) ?>

<?php $this->start('main_content') ?>

<!-- formulaire changement à remplir pour changer coordonées user -->
<p class="updateInfoTitle"> Modifier mon compte. <p>
<form method="POST" class="pure-form" name="updateInfos" id="updateInfos">
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
	</div>

	<div class="form-goup">
		<label for="passwd">Mot de passe</label>
		<input type="password" id="password" name="password" placeholder="Votre mot de passe">
	</div>
	<div class="form-goup">
		<label for="passwd">Confirmez votre mot de passe</label>
		<input type="password" id="password" name="password_confirm" placeholder="Votre mot de passe">
	</div>
	<input class="form-control" type="text" placeholder="www.mon_image.com" style="color:black" type="text" name="url"/>


	<button type="submit" class="btn btn-default">Submit</button>	
</form>
<div id="infosUpdate"></div>

<?php $this->stop('main_content') ?>