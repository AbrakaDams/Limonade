<?php $this->layout('layoutNoConnect', ['title' => 'Login']) ?>

<?php $this->start('main_content') ?>

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



<form method="post" class="form-inline">
	<div class="form-group" id="form-login">
		<h2 class="centerNoConnect">Se connecter ?</h2>
		<label for="email" id="formContact">Votre email :</label><br>
		<input class="form-control" type="email" id="email" name="email" placeholder="Votre email">
		<br><br>
		<label for="password" id="formContact">Votre mot de passe :<br>
		<a href="<?= $this->url('user_getNewPassword'); ?>">Mot de passe oublié </a></label> <i class="fa fa-question-circle" aria-hidden="true"></i><br>
		<input class="form-control" type="password" id="password" name="password" placeholder="Votre mot de passe">
		<br><br>
		<input class="submit" type="submit" value="Connexion">
		<br><br>
		<a href="<?=$this->url('user_loginFacebook');?>" class="btn btn-primary" style="border-radius:0;">
		<i class="fa fa-facebook square"></i>
		Connexion Facebook
		</a>
	<br><br><hr>
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
