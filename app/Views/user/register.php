<?php $this->layout('layoutNoConnect', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>

	<form method="post" class="form-inline" id="createUser" enctype="multipart/form-data">
		<h1 class="center"> CRÉATION D'UN COMPTE EN UN SEUL CLIC ! </h1>
		<p class="subttle"> Un compte sur Limonade vous donnera accès à tous nos services de gestion d'évènements </p>

	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
		<?=implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

	<?php if(isset($success) && $success === true): ?>
		<div class="alert alert-success">
		<p> Votre inscription a bien été prise en compte. Bienvenue chez nous! <br> Veuillez consulter vos emails pour confirmer votre mot de passe ! </p>
		</div>
	<?php endif; ?>

	<?php  if(isset($w_user) && !empty($w_user)): ?>

		<p><strong>Vous êtes déjà connecté(e). <br><a href="<?= $this->url('default_home') ?>"> Retour Accueil </a></strong></p>

	<?php  else: ?>
		<div class="form-group">
		<hr>
			<a href="<?=$this->url('user_loginFacebook');?>" class="btn btn-primary" style="border-radius:0;">
				<i class="fa fa-facebook square"></i>Connexion Facebook 
			</a>
			<hr>
			<label class="register-label" for="username">Pseudo*:</label>
			<input class="form-control" type="text" placeholder="JohnnyBravo" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>" required>
			<br><br>
			<label class="register-label"  for="email">Email*:</label>
			<input class="form-control" type="email" placeholder="JohnDoe@email.com" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>" required>
			<br><br>
			<label class="register-label"  for="firstname">Prénom*:</label>
			<input class="form-control" type="text" placeholder="John" name="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname'];} ?>" required>
			<br><br>
			<label class="register-label"  for="lastname">Nom*:</label>
			<input class="form-control" type="text" placeholder="Doe" type="text" name="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname'];} ?>" required>
			<br><br>
			<label class="register-label" for="password">Mot de passe* :</label>
			<input class="form-control" type="password" placeholder="Mot de passe" name="password" required>
			<br><br>
			<label class="register-label" for="password_confirm">Mot de passe* :</label>
			<input class="form-control" type="password" placeholder="Confirmation Mot de passe" name="password_confirm" required>
			<hr>
			<label class="register-label" for="avatar">Lien photo de profil :</label>
			<input class="form-control" type="text" placeholder="www.mon_image.com" name="url"/>
			<br><br> 
			<label class="register-label" for="avatar">Choisisez une photo de profil :</label>
			<!-- Le champ MAX_FILE_SIZE permettra de limiter la taille du fichier envoyé (valeur en octets). Il doit précéder le champ de type "file" -->
	  		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
			<input class="file" id="input-1" type="file" name="avatar">
			<input class="form-control"  type="submit" value="Envoyer" />
			<hr>	
		</div>
		<br><strong> Vous avez déjà un compte? <a href="<?= $this->url('user_login') ?>"> Connectez-vous</a></strong>
	</form>

<?php endif; ?>
<br>
<?php $this->stop('main_content') ?>
