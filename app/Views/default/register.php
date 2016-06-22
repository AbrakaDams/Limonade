<?php $this->layout('layout', ['title' => 'inscription']) ?>

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

	<?php if(isset($successimg) && $successimg === true): ?>
		<div class="alert alert-success">
		<p> Voici votre photo de profil </p>
		<?php echo '<img src="' .$avatar. '">'; ?>
		</div>
		<div class="alert alert-success">
		<?php echo  'bonjour :' .$_POST['username'] ; ?>
		</div>
	<?php endif; ?>

<form method="post" class="form-inline" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname"> Prénom </label>
		<input class="form-control" type="text" placeholder="Prénom..." type="text" style="color:black" name="firstname"/>
		<br><br>
		<label for="lastname"> Nom </label>
		<input class="form-control" type="text" placeholder="Nom..." type="text" style="color:black" name="lastname"/>
		<br><br>
		<label for="email"> votre email </label>
		<input class="form-control" type="email" placeholder="Email..." type="text" style="color:black" name="email"/>
		<br><br>
		<label for="password"> votre password </label>
		<input class="form-control" type="password" placeholder="password..." type="text" style="color:black" name="password"/>
		<br><br>
		<label for="username"> Pseudo </label>
		<input class="form-control" type="text" placeholder="Pseudo..." type="text" style="color:black" name="username"/>
		<br><br>
		<!-- Le champ MAX_FILE_SIZE permettra de limiter la taille du fichier envoyé (valeur en octets). Il doit précéder le champ de type "file" -->  
	  	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
		<input type="file" name="avatar">
		<br>
		<input type="submit" style="color:black" value="Envoyer" />
	</div>
</form>
	
<?php $this->stop('main_content') ?>