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
  		<label for="email">Votre email :</label><br>
  		<input class="form-control" type="email" id="email" name="email" placeholder="votre email">
  		<br><br>
  		<label for="password">Votre mot de passe <br><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
<a href="<?= $this->url('user_getNewPassword'); ?>">Mot de passe oublié?</a></label><br>
  		<input class="form-control" type="password" id="password" name="password" placeholder="votre mot de passe">
  		<br><br>
  		<input class="form-control" type="submit" value="Connexion">
  		<br><br>
  		<a href="<?= $this->url('default_home') ?>">Retour Accueil</a>
      <br>
  		<a href="<?= $this->url('user_register') ?>"><strong>Créer un compte</strong></a>
    </div>
	</form>

<?php  endif; ?>

<?php $this->stop('main_content') ?>
