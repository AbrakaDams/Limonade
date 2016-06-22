<?php $this->layout('layout', ['title' => 'Login']) ?>

<?php $this->start('main_content') ?>

<?php
	// $w_user est accessible dans tout les fichiers de vue (Views/)
	// elle retourne les infos de l'utilisateur connecté ou null sinon
	if(!empty($w_user)){
		echo '<br><br>';
		// echo '<a href="'.$this->url('user_logout').'">Déconnexion</a>';
		echo '<br><br>';
	} ?>

	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<?= implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

	<form method="post" class="form-inline">
    <div class="form-group">
  		<label for="email">Votre email :</label>
  		<input class="form-control" type="email" id="email" name="email" placeholder="votre email">
  		<br><br>
  		<label for="password">Votre mot de passe (<a href="#">Mot de passe oublier</a>):</label>
  		<input class="form-control" type="password" id="password" name="password" placeholder="votre mot de passe">
  		<br><br>
  		<input class="form-control" type="submit" value="Connexion">
  		<br><br>
  		<a href="<?= $this->url('default_home') ?>">Retour Accueil</a>
      <br>
  		<a href="<?= $this->url('user_register') ?>">créer un compte</a>
    </div>
	</form>

<?php $this->stop('main_content') ?>
