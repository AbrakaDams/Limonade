

<!-- Formulaire pour modifier l'évènement -->
<p class="checkEvent"> Modifier mon évènement. <p>
<?php if(isset($success) && $success == true): ?>
	<div class="alert alert-success">
		<p>Tout est bon, votre évènement a bien été modifié.</p>
	</div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">
		<p>Il ya des erreurs</p>
		<?= implode('<br>', $errors); ?>
	</div>
<?php endif; ?>


<form method="post" class="form-create-event" id="createEvent" onsubmit="return validateForm()">
	<h1 class="center">Votre événement</h1>
	<hr>
	<div class="row">
	    <div class="col-xs-6 .col-md-4">
	      	<label for="type-event">Etendue de votre l'événement</label><br>
	      	<input type="radio" name="role" id="private" value="<?php echo $event['role']; ?>">
	        <label for="private" class="masterTooltip" title="Seul les personnes invitées peuvent voir l'événement, ses membres et leurs publications.">Privée 
	        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></label>
	        <br>
	        <input type="radio" name="role" id="public" value="<?php echo $event['role']; ?>">
	        <label for="public" class="masterTooltip" title="Tout le monde peut voir l'événement, ses membres et leurs publications.Et donc y participer.">Publique <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></label>
	    	<br>
	    </div>     
	    <div class="col-xs-6 .col-md-4">
	      	<label for="cat-event" class="masterTooltip" title="Ceci est le style de votre évènement">Catégorie de votre événement <i class="fa fa-info-circle" aria-hidden="true"></i></label>
	      	<br>
	      	<select name="cat_event" id="category">
	      	<option value="<?php echo $event['category']; ?>">Repas</option>
	      	<option value="<?php echo $event['category']; ?>">Soirées</option>
	      	<option value="<?php echo $event['category']; ?>">Vacances</option>
	      	<option value="<?php echo $event['category']; ?>">Journées</option>
	      	</select>
	      	<br>
	    </div>
	</div>
	<hr>
	<div class="row">
	    <div class="col-xs-6 .col-md-4">
	      	<label for="title-event" class="masterTooltip" title="Indiquer un titre à votre évènement.Ne vous inquiétez pas, vous aurez la possibilité de la changer ulterieurement">Intitulé de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label> <br>
	        <input type="text" name="title" id="title-event" value="<?php echo $event['title']; ?>"><br><br>
	    </div>
	    <div class="col-xs-6 .col-md-4">    
	      	<label for="description" class="masterTooltip" title="Entre une brève description de votre évènement">Description de votre évenement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<textarea name="description" id="description" rows="3" cols="70" value="<?php echo $event['description']; ?>"></textarea>
	    </div>  
	</div>
	<hr>
	<div class="form-group">        
	     <label for="lieu-event" class="masterTooltip" title="Si vous voulez avoir du monde à votre évènement, nous conseillons vivement de remplir l'adresse">Adresse de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	     <textarea name="address" id="address" rows="5" cols="70" value="<?php echo $event['address']; ?>"></textarea>
	</div>
	<hr>
	<div class="row">
	    <div class="col-xs-6 .col-md-4">
		    <i class="fa fa-hourglass-start fa-2x" aria-hidden="true"> Début</i><br>
		    <label for="date_begin" class="masterTooltip" title="Début de votre évènement">Date du début de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
		    <input type="date" name="date_begin" value="<?php echo $event['date_start']; ?>">
		    <br>
		    <label for="time_begin" class="masterTooltip" title="Début de votre évènement">Heure du début de votre évènemet:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
		    <input type="time" name="time_begin" value="<?php echo $event['date_start']; ?>">
	    </div>    
	    <div class="col-xs-6 .col-md-4">
	      	<i class="fa fa-hourglass-end fa-2x" aria-hidden="true"> Fin</i><br>
	      	<label for="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Date de la fin de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<input type="date" name="date_end" value="<?php echo $event['date_end']; ?>">
	      	<br>
	      	<label for="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Heure de la fin de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<input type="time" name="time_end" value="<?php echo $event['date_end']; ?>">
	    </div>
	</div>
	<hr>  
	<button type="submit" id="modifEvent" class="btn btn-primary">Modifier</button>
</form>

<div id="eventUpdate"></div>

<?php $this->stop('main_content') ?>

