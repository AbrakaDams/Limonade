<?php $this->layout('layout', ['title' => 'Login']) ?>

<?php $this->start('main_content') ?>

<div class="lemonade-bg" style="background-image: url(<?= $this->assetUrl('img/lemonade-3.png')?>)">

	<div class="lemonade-bg-container">
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<?= implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

<?php  if(isset($w_user) && !empty($w_user)): ?>
  <br>
  <p>
    <strong>Vous êtes déjà connecté(e). <br><a href="<?= $this->url('default_home') ?>">Retour Accueil</a></strong>
  </p>
<?php  else: ?>

	<h1 class="center">Connectez-vous par accéder au site</h1>


	<form method="post" id="form-login">
		<hr>
		<a href="<?=$this->url('user_loginFacebook');?>" class="btn btn-primary" style="border-radius:0;">
			<i class="fa fa-facebook square"></i>
			Connexion Facebook
		</a>
		<hr>
		
		<div class="form-group">
			<label for="email">Votre email :</label><br>
			<input class="form-control" type="email" id="email" name="email" placeholder="Votre email">
		</div>

		<div class="form-group">
			<label for="password">Votre mot de passe :<br></label><br>
			<input class="form-control" type="password" id="password" name="password" placeholder="Votre mot de passe">

			<a href="<?= $this->url('user_getNewPassword'); ?>">Mot de passe oublié ?</a>
		</div>

		<div class="form-group">
			<input class="btn btn-default" type="submit" value="Connexion">
		</div>
			<div class="option" id="option-contact">
				<i class="fa fa-home" aria-hidden="true"></i>
				<a href="<?= $this->url('default_home') ?>">Retour Accueil</a>
				<br>
				<i class="fa fa-user-plus" aria-hidden="true"></i><a href="<?= $this->url('user_register') ?>"><strong>Créer un compte</strong></a>
			</div>
		</div>
	</form>

<?php  endif; ?>

<?php $this->stop('main_content') ?>
