<?php $this->layout('layoutAdmin', ['title' => 'Modifier un évènement']) ?>

<?php $this->start('main_content') ?>

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
	      		<input type="radio" name="role" id="private" value="private"<?php if($eventData['role'] == 'private'){ echo 'checked';}?>>Privée
	      		<input type="radio" name="role" id="public" value="public"<?php if($eventData['role'] == 'public'){ echo 'checked';}?>>Publique
	    	<br>
	    </div>     
	    <div class="col-xs-6 .col-md-4">
	      <label for="cat-event" class="masterTooltip" title="Ceci est le style de votre évènement">Catégorie de votre événement <i class="fa fa-info-circle" aria-hidden="true"></i></label>
	      	<br>	        
	      	<select>
	      		<option value="vacances"<?php if($eventData['category'] == 'vacances'){ echo 'selected';}?>>Vacances</option>	      		
	      		<option value="soiree"<?php if($eventData['category'] == 'soiree'){ echo 'selected';}?>>Soirées</option>
	      		<option value="repas"<?php if($eventData['category'] == 'repas'){ echo 'selected';}?>>Repas</option>	      		
	      		<option value="journee"<?php if($eventData['category'] == 'journee'){ echo 'selected';}?>>Journées</option>
	      	</select>
    	</div>	    
	</div>
	<hr>
	<div class="row">
	    <div class="col-xs-6 .col-md-4">
	      	<label for="title-event" class="masterTooltip" title="Indiquer un titre à votre évènement.Ne vous inquiétez pas, vous aurez la possibilité de la changer ulterieurement">Intitulé de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label> <br>
	        <input type="text" name="title" id="title-event" value="<?php echo $eventData['title']; ?>"><br><br>
	    </div>
	    <div class="col-xs-6 .col-md-4">    
	      	<label for="description" class="masterTooltip" title="Entre une brève description de votre évènement">Description de votre évenement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<textarea name="description" id="description" rows="3" cols="70"><?php echo $eventData['description']; ?></textarea>
	    </div>  
	</div>
	<hr>
	<div class="form-group">        
	     <label for="lieu-event" class="masterTooltip" title="Si vous voulez avoir du monde à votre évènement, nous conseillons vivement de remplir l'adresse">Adresse de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	     <textarea name="address" id="address" rows="5" cols="70"><?php echo $eventData['address']; ?></textarea>
	</div>
	<hr>
	<div class="row">
	    <div class="col-xs-6 .col-md-4">
		    <i class="fa fa-hourglass-start fa-2x" aria-hidden="true"> Début</i><br>
		    <label for="date_begin" class="masterTooltip" title="Début de votre évènement">Date du début de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
		    <input type="date" name="date_start" value="<?php echo $eventData['date_start']; ?>">
		    <br>
		    <label for="time_begin" class="masterTooltip" title="Début de votre évènement">Heure du début de votre évènement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
		    <input type="time" name="time_start" value="<?php echo $eventData['date_start']; ?>">
	    </div>    
	    <div class="col-xs-6 .col-md-4">
	      	<i class="fa fa-hourglass-end fa-2x" aria-hidden="true"> Fin</i><br>
	      	<label for="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Date de la fin de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<input type="date" name="date_end" value="<?php echo $eventData['date_end']; ?>">
	      	<br>
	      	<label for="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Heure de la fin de votre événement:<i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
	      	<input type="time" name="time_end" value="<?php echo $eventData['date_end']; ?>">
	    </div>	
	</div>
	<hr>  
	<button type="submit" id="modifEvent" class="btn btn-primary">Modifier</button>
</form>

<div id="eventUpdate"></div>

<?php $this->stop('main_content') ?>

