<?php $this->layout('layoutAdmin', ['title' => 'Modifier un évènement']) ?>

<?php $this->start('main_content') ?>

<!-- Formulaire pour modifier l'évènement -->
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

<?php var_dump($eventData); ?>
<form method="post" class="form-create-event" id="createEvent" onsubmit="return validateForm()">
	<h1 class="center">Modifier un évènement</h1>	
	<hr>
	<div class="row">	
	    <div class="col-xs-6 .col-md-4">
	      	<label for="type-event">Etendue de votre événement</label><br>
	      		<input type="radio" name="role" id="private" value="private"<?php  if($eventData['role'] == 'private'){ echo 'checked';}?>>Privée
	      		<input type="radio" name="role" id="public" value="public"<?php if($eventData['role'] == 'public'){ echo 'checked';}?>>Publique
	    	<br>
	    </div>     
	    <div class="col-xs-6 .col-md-4">
	      <label for="cat-event" class="masterTooltip" title="Ceci est le style de votre évènement">Catégorie de votre événement <i class="fa fa-info-circle" aria-hidden="true"></i></label>
	      	<br>	        
	      	<select name="category">
	      		<option name="category" value="vacances"<?php if($eventData['category'] == 'vacances'){ echo 'selected';}?>>Vacances</option>	      		
	      		<option name="category" value="soiree"<?php if($eventData['category'] == 'soiree'){ echo 'selected';}?>>Soirées</option>
	      		<option name="category" value="repas"<?php if($eventData['category'] == 'repas'){ echo 'selected';}?>>Repas</option>	      		
	      		<option name="category" value="journee"<?php if($eventData['category'] == 'journee'){ echo 'selected';}?>>Journées</option>
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
      <div class='col-xs-6 col-md-4'>
          <div class="form-group" id="date_start">
            <i class="fa fa-hourglass-start fa-2x" aria-hidden="true"> Début de votre événement</i><br><br>
            <label for="date_start" name="date_start" class="masterTooltip" title="Début de votre évènement">Date et heure : <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
              <div class="input-group">
                  <input type="text" name="date_start" class="form-control" id='datetimepickerstart' value="<?php echo $eventData['date_start']; ?>">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class='col-xs-6 col-md-4'>
          <div class="form-group" id="date_end">
            <i class="fa fa-hourglass-end fa-2x" aria-hidden="true"> Fin de votre événement</i><br><br>
            <label for="date_end" name="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Date et heure: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
              <div class="input-group">
                  <input type="text" name="date_end" class="form-control" id='datetimepickerend' value="<?php echo $eventData['date_end']; ?>">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
  </div>	
	<hr>  
	<button type="submit" id="modifEvent" class="btn btn-primary">Modifier votre évènement</button>
</form>

<div id="eventUpdate"></div>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
  <script src="<?= $this->assetUrl('js/moment.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?= $this->assetUrl('js/tooltip.js') ?>"></script>
<?php $this->stop('js') ?>

