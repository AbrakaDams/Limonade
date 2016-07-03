<?php $this->layout('layout', ['title' => 'Modifier l\'évènement']) ?>

<?php $this->start('main_content') ?>

<div class="lemonade-bg" style="background-image: url(<?= $this->assetUrl('img/lemonade-1.jpg')?>)">

    <div class="lemonade-bg-container">
	<!-- Formulaire pour modifier l'évènement -->
	<?php if(isset($success) && $success == true): ?>
		<div class="alert alert-success">
			<p>Tout est bon, votre évènement a bien été modifié.</p>
			<a href="<?= $this->url('event_showEvent', ['id' => $eventData['id']]);?>">Retour à votre évènement</a>
		</div>
	<?php endif; ?>

	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<?= implode('<br>', $errors); ?>
		</div>
	<?php endif; ?>

		<h1 class="center">Modifier votre évènement</h1>

			<form method="post" enctype="multipart/form-data" class="form-create-event" id="createEvent" onsubmit="return validateForm()">

	            <div class="form-group two-inputs-aside beckille">
			      	<label for="type-event">Visibilité de votre événement</label><br>
			      	<input type="radio" name="role" id="private" value="private"<?php if(!empty($data) && $success !== true && $data['role'] == 'private'){echo 'checked' ;}?>>
		            <label for="private" class="masterTooltip" title="Seul les personnes invitées peuvent voir l'événement, ses membres et leurs publications.">Privé
		            	<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
		            </label>
		            <br>
			      	<input type="radio" name="role" id="public" value="public"<?php if(!empty($data) && $success !== true && $data['role'] == 'public'){echo 'checked' ;}?>>
		            <label for="public" class="masterTooltip" title="Tout le monde peut voir l'événement, ses membres et leurs publications.Et donc y participer.">Public
		            	<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		            </label>
			    	<br>
		    	</div>

		    	<div class="form-group two-inputs-aside">
                    <label for="cat-event" class="masterTooltip" title="Ceci est le style de votre évènement">Type d'événement
                    	<i class="fa fa-info-circle" aria-hidden="true"></i>
                    </label>
                    <br>
                    <input type="radio" name="category" value="repas" id="repas" <?php if(!empty($data) && $success !== true && $data['category'] == 'repas'){echo 'checked' ;}?>>
                    <label for="repas" class="masterTooltip" title="Repas de famille, Anniversaire, etc">Repas</label><br>
                    <input type="radio" name="category" value="soiree" id="soiree" <?php if(!empty($data) && $success !== true && $data['category'] == 'soiree'){echo 'checked' ;}?>>
                    <label for="soiree" class="masterTooltip" title="Soirée de départ de Jean au Japon, soirée à thème, etc">Soirée</label> <br>
                    <input type="radio" name="category" value="vacances" id="vacances" <?php if(!empty($data) && $success !== true && $data['category'] == 'vacances'){echo 'checked' ;}?>>
                    <label for="vacances" class="masterTooltip" title="Séjour en Espagne, camping etc">Vacance</label><br>
                    <input type="radio" name="category" value="journee" id="journee" <?php if(!empty($data) && $success !== true && $data['category'] == 'journee'){echo 'checked' ;}?>>
                    <label for="journee" class="masterTooltip" title="Journée plage, après-midi jeux de sociétés, etc">Journée</label>
                </div>

				<hr>

				<div class="form-group">
					<label for="avatar-event" class="masterTooltip" title="Choissisez une image a l'éfigie de votre évènement">Avatar évènement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
					<input class="form-control" type="text" value="<?php echo $eventData['event_avatar']; ?>" name="eventAvatar"/><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
					<input class="file" id="input-1" type="file" name="avatar">
				</div>

				<hr>

				<div class="form-group">
			      	<label for="title-event" class="masterTooltip" title="Changez le titre de votre événement">Nom d'événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label> <br>
			        <input type="text" name="title" class="form-control" id="title-event" value="<?php echo $eventData['title']; ?>">
			    </div>


			    <div class="form-group">
			      	<label for="description" class="masterTooltip" title="Entre une brève description de votre évènement">Description de votre évenement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
			      	<textarea name="description" class="form-control" id="description" rows="3" cols="70"><?php echo $eventData['description']; ?></textarea>
			    </div>


		        <div class="form-group">
				     <label for="lieu-event" class="masterTooltip" title="Si vous voulez avoir du monde à votre évènement, nous conseillons vivement de remplir l'adresse">Adresse de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
				     <textarea name="address" class="form-control" id="address" rows="5" cols="70"><?php echo $eventData['address']; ?></textarea>
				</div>

				<hr>

				<div class="form-group two-inputs-aside beckille" id="date_start">

					<label for="date_start" name="date_start" class="masterTooltip" title="Début de votre évènement"> <i class="fa fa-hourglass-start" aria-hidden="true"></i> Début d'événement (date et heure) :
						<i class="fa fa-info-circle" aria-hidden="true"></i>
					</label><br>
					<div class="input-group">
						<input type="text" name="date_start" class="form-control" id='datetimepickerstart' value="<?php echo date('d/m/Y H:i', strtotime($eventData['date_start'])); ?>">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
			    </div>

				<div class="form-group two-inputs-aside" id="date_end">

				    <label for="date_end" name="date_end" class="masterTooltip" title="Fin de votre événement"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Fin de votre événement (date et heure) : <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
				    <div class="input-group">
				        <input type="text" name="date_end" class="form-control" id='datetimepickerend' value="<?php echo date('d/m/Y H:i', strtotime($eventData['date_end'])); ?>">
				    	<span class="input-group-addon">
				             <span class="glyphicon glyphicon-calendar"></span>
				        </span>
				    </div>
				</div>
				<br><br>
				<div class="validcreate-event">
					<button type="submit" id="modifEvent" class="btn btn-primary center-block">Sauvegarder</button>
				</div>
			</form>
		</div><!-- fin du container -->

<div id="eventUpdate"></div>

	</div>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
  <script src="<?= $this->assetUrl('js/moment.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?= $this->assetUrl('js/tooltip.js') ?>"></script>
<?php $this->stop('js') ?>


<?php $this->stop('main_content') ?>
