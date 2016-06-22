<?php $this->layout('layout', ['title' => 'inscription']) ?>

<?php $this->start('main_content') ?>

<?php
	// $w_user est accessible dans tout les fichiers de vue (Views/)
	// elle retourne les infos de l'utilisateur connecté ou null sinon
	if(!empty($w_user)){
		var_dump($w_user);
		echo '<br><br>';
		echo '<a href="'.$this->url('user_logout').'">Déconnexion</a>';
		echo '<br><br>';
	} ?>

	<?php if(!empty($errors)): ?>
		<div style="color:red">
			<?= implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

	<form method="post">
		<label for="email">Votre email :</label>
		<input type="email" id="email" name="email" placeholder="votre email">
		<br><br>
		<label for="password">Votre mot de passe :</label>
		<input type="password" id="password" name="password" placeholder="votre mot de passe">
		<br><br>
		<input type="submit" value="Connexion">
		<br><br>
		<a href="<?= $this->url('default_home') ?>">Retour Accueil</a>
	</form>

<?php $this->stop('main_content') ?>
