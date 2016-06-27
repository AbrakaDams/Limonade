<?php $this->layout('layoutNoConnect', ['title' => 'inscription']) ?>

<?php $this->start('main_content') ?>

	<h1> CREATION D'UN COMPTE EN UN SEUL CLIC ! </h1>
	<br>
	<p> Un compte sur Limonde vous donne accès à tout nos services d'organisation </p>

	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
		<?=implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

	<?php if(isset($success) && $success === true): ?>
		<div class="alert alert-success">
		<p> Votre inscription a bien été prise en compte. Bienvenue ! </p>
		</div>
	<?php endif; ?>

	<?php  if(isset($w_user) && !empty($w_user)): ?>

	  <br>
	  <p>
	    <strong>Vous etes deja connectez. <br><a href="<?= $this->url('default_home') ?>">Retour Accueil</a></strong>
	  </p>


	<?php  else: ?>

<form method="post" class="form-inline" enctype="multipart/form-data">
	<div class="form-group">
		<label for="username">Pseudo* :</label>
		<input class="form-control" type="text" placeholder="JohnnyBravo" type="text" style="color:black" name="username" required>
		<br><br>
		<label for="firstname">Prénom* :</label>
		<input class="form-control" type="text" placeholder="John" type="text" style="color:black" name="firstname" required>
		<br><br>
		<label for="lastname">Nom* :</label>
		<input class="form-control" type="text" placeholder="Doe" type="text" style="color:black" name="lastname" required>
		<br><br>
		<label for="email">Email* :</label>
		<input class="form-control" type="email" placeholder="JohnDoe@email.com" type="text" style="color:black" name="email" required>
		<br><br>
		<label for="password">Mot de passe* :</label>
		<input class="form-control" type="password" placeholder="Mot de passe" type="text" style="color:black" name="password" required>
		<br><br>
		<label for="password_confirm">Confirmation Mot de passe* :</label>
		<input class="form-control" type="password" placeholder="Confirmation Mot de passe " type="text" style="color:black" name="password_confirm" required>

		<br><br>
		<label for="avatar">Choisisez une photo de profil :</label>
		<input class="form-control" type="text" placeholder="www.mon_image.com" style="color:black" type="text" name="url"/>
		<!-- Le champ MAX_FILE_SIZE permettra de limiter la taille du fichier envoyé (valeur en octets). Il doit précéder le champ de type "file" -->
	  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
		<input type="file" name="avatar">
		<br>
		<input type="submit" style="color:black" value="Envoyer" />
	</div>
</form>

<br><br><strong>Vous avez deja un compte ? <a href="<?= $this->url('user_login') ?>">Connectez-vous</a></strong>


<?php endif; ?>
<br><br><br><br>
<?php $this->stop('main_content') ?>
