<?php $this->layout('layout', ['title' => 'Modifier vos informations']) ?>

<?php $this->start('main_content') ?>

<!-- formulaire changement à remplir pour changer coordonées user -->
	<p class="updateInfoTitle"> Modifier mon compte. <p>

  <form method="POST" class="pure-form" name="updateInfos" id="updateInfos">

  		<div class="form-group">
  			<label for="ident">Pseudo</label>
			<input type="text" id="ident" name="username" placeholder="votre pseudo">
		</div>

		<div class="form-group">
  			<label for="ident">Prénom</label>
			<input type="text" id="ident" name="firstname" placeholder="votre prénom">
		</div>

		<div class="form-group">
  			<label for="ident">Nom de famille</label>
			<input type="text" id="ident" name="lastname" placeholder="votre nom">
		</div>

  		<div class="form-group">
    		<label for="exampleInputFile"> Charger mon image </label>
    		<input name="avatar" type="file" id="img1">
    		<p class="help-block"> mon avatar <br></p>
  		</div>

  		<div class="form-goup">
			<label for="passwd">Mot de passe</label>
			<input type="password" id="password" name="password" placeholder="Votre mot de passe">>
		</div>

  		<button type="submit" class="btn btn-default">Submit</button>

	</form>

    	<div id="infosUpdate"></div>

<?php $this->stop('main_content') ?>