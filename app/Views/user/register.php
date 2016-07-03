<?php $this->layout('layout', ['title' => 'Inscription']) ?>

<?php $this->start('main_content') ?>

	<div class="lemonade-bg" style="background-image: url(<?= $this->assetUrl('img/lemonade-1.jpg')?>)">

		<div class="lemonade-bg-container">
			<h1	class="center">Remplissez le formulaire pour créer votre compte</h1>
			<p> Un compte sur Limonade vous donnera accès à tous nos services de création d'évènements. </p>


			<?php if(!empty($errors)): ?>
				<div class="alert alert-danger">
				<?=implode('<br>', $errors); ?>
				</div>
			<?php endif; ?>

			<?php if(isset($success) && $success === true): ?>
				<div class="alert alert-success">
				<p> Votre inscription a bien été prise en compte.<br> Veuillez consulter vos emails pour confirmer votre mot de passe ! </p>
				</div>
			<?php endif; ?>

			<?php  if(isset($w_user) && !empty($w_user)): ?>
				<p><strong>Vous êtes déjà connecté(e). <br><a href="<?= $this->url('default_home') ?>"> Retour Accueil </a></strong></p>
			<?php  else: ?>

			<form method="post" id="createUser" enctype="multipart/form-data">
				<div class="form-group">
				<hr>
					<a href="<?=$this->url('user_loginFacebook');?>" class="btn btn-primary" style="border-radius:0;">
						<i class="fa fa-facebook square"></i> 	Connexion Facebook
					</a>
					<hr>
				</div>

				<div class="form-group">
					<label class="register-label" for="username">Pseudo*:</label>
					<input class="form-control" type="text" placeholder="JohnnyBravo" name="username" value="<?php if(!isset($success) && $success === false){if(isset($_POST['username'])){ echo $_POST['username'];}} ?>" required>
				</div>

				<div class="form-group">
					<label class="register-label"  for="email">Email*:</label>
					<input class="form-control" type="email" placeholder="JohnDoe@email.com" name="email" value="<?php if(!isset($success) && $success === false){if(isset($_POST['email'])){ echo $_POST['email'];}} ?>" required>
				</div>

				<div class="form-group">
					<label class="register-label"  for="firstname">Prénom*:</label>
					<input class="form-control" type="text" placeholder="John" name="firstname" value="<?php if(!isset($success) && $success === false){if(isset($_POST['firstname'])){ echo $_POST['firstname'];}} ?>" required>
				</div>

				<div class="form-group">
					<label class="register-label"  for="lastname">Nom*:</label>
					<input class="form-control" type="text" placeholder="Doe" type="text" name="lastname" value="<?php if(!isset($success) && $success === false){if(isset($_POST['lastname'])){ echo $_POST['lastname'];}} ?>" required>
				</div>

				<div class="form-group">
					<label class="register-label" for="password">Mot de passe* :</label>
					<input class="form-control" type="password" placeholder="Mot de passe" name="password" required>
				</div>

				<div class="form-group">
					<label class="register-label" for="password_confirm">Mot de passe* :</label>
					<input class="form-control" type="password" placeholder="Confirmation Mot de passe" name="password_confirm" required>
					<hr>
				</div>

				<div class="form-group">
					<label class="register-label" for="avatar">Choissiez une Photo de profil :</label><br>
					<input class="form-control" type="text" placeholder="www.lien-de-mon-image.com" name="url"/>
				</div>

				<div class="form-group">
					<!-- Le champ MAX_FILE_SIZE permettra de limiter la taille du fichier envoyé (valeur en octets). Il doit précéder le champ de type "file" -->
					<label>Ou ajoutez un image :</label>
					<br>
			  		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
					<input class="file" id="input-1" type="file" name="avatar">
				</div>
					<input type="submit" value="Envoyer" />
					<hr>
				<!-- </div> -->
				<br><strong> Vous avez déjà un compte? <a href="<?= $this->url('user_login') ?>"> Connectez-vous</a></strong>
			</form>
			<?php endif; ?>
		</div>
	</div>

<?php $this->stop('main_content') ?>
