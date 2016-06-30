<?php $this->layout('layout', ['title' => '']) ?>

<?php $this->start('main_content') ?>

<?php if(!isset($w_user) && empty($w_user)): ?>

  <h2>
    <a href="<?= $this->url('user_login') ?>"><strong>Connectez-vous</strong></a>
    Ou
    <a href="<?= $this->url('user_register') ?>"><strong>Inscrivez-vous</strong></a>
    pour pourvoir créer un évènement !
  </h2>

<?php else: ?>

<?php if(isset($success) && $success === true): ?>
<div class="alert alert-success">
    <p style="color:green;">Votre évènement a bien été créé.</p>
    <p><a href="<?= $this->url('event_showEvent', ['id' => $newEvent['id']]);?>">Aller à l'évènement</a></p>
  <?php endif; ?>
</div>

<?php if(isset($errors) && !empty($errors)): ?>
<div class="alert alert-warning">
  <p style="color:red;">
    <?php foreach ($errors as $err) {
      echo $err.'<br>';
    }
    ?>
  </p>
<?php endif; ?>
</div>
  <hr>

<form method="post" class="form-create-event" id="createEvent" onsubmit="return validateForm()">
<h1 class="center">Votre événement</h1>
<!--<progress max="100" value="0" form="form-id">0%</progress>-->
<hr>
  <div class="row">
    <div class="col-xs-6 .col-md-4">
      <label for="type-event">Etendue de votre l'événement</label><br>
        <input type="radio" name="role" id="private" value="private">
        <label for="private" class="masterTooltip" title="Seul les personnes invitées peuvent voir l'événement, ses membres et leurs publications.">Privée 
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></label>
        <br>
        <input type="radio" name="role" id="public" value="public">
        <label for="public" class="masterTooltip" title="Tout le monde peut voir l'événement, ses membres et leurs publications.Et donc y participer.">Publique <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></label>
    <br>
    </div> 
    
    <div class="col-xs-6 .col-md-4">
      <label for="cat-event" class="masterTooltip" title="Ceci est le style de votre évènement">Catégorie de votre événement <i class="fa fa-info-circle" aria-hidden="true"></i></label>
      <br>
        <input type="radio" name="category" value="repas" id="repas"> <label for="repas" class="masterTooltip" title="Repas de famille, Anniversaire, etc">Repas</label><br>
        <input type="radio" name="category" value="soiree" id="soiree"> <label for="soiree" class="masterTooltip" title="Soirée de départ de Jean au Japon, soirée à thème, etc">Soirées</label><br>
        <input type="radio" name="category" value="vacances" id="vacances"> <label for="vacances" class="masterTooltip" title="Séjour en Espagne, camping etc">Vacances</label><br>
        <input type="radio" name="category" value="journee" id="journee"> <label for="journee" class="masterTooltip" title="Journée plage, après-midi jeux de sociétés, etc">Journées</label><br>
    </div>
  </div>
  <hr>  

  <div class="row">
    <div class="col-xs-6 .col-md-4">
      <label for="title-event" class="masterTooltip" title="Indiquer un titre à votre évènement.Ne vous inquiétez pas, vous aurez la possibilité de la changer ulterieurement">Intitulé de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label> <br>
        <input type="text" name="title" placeholder="Le titre" required><br><br>
    </div>
    <div class="col-xs-6 .col-md-4">    
      <label for="description" class="masterTooltip" title="Entre une brève description de votre évènement">Description de votre évenement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
      <textarea name="description" rows="3" cols="70" placeholder="Une brève description de votre événement "></textarea>
    </div>  
  </div>
  <hr>
  <div class="form-group">        
      <label for="lieu-event" class="masterTooltip" title="Si vous voulez avoir du monde à votre évènement, nous vous conseillons vivement d'indiquer une adresse.Vous aurez la possibilité de la changer ulterieurement">Adresse de votre événement: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>        
      <textarea name="address" rows="5" cols="70" placeholder="L'adresse de votre événement" required></textarea>
  </div>
  <hr>

  <div class="row">
      <div class='col-xs-6 col-md-4'>
          <div class="form-group">
            <i class="fa fa-hourglass-start fa-2x" aria-hidden="true"> Début de votre événement</i><br><br>
            <label for="date_start" name="date_start" class="masterTooltip" title="Début de votre évènement">Date et heure : <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
              <div class='input-group date' id='datetimepicker6' name="date_start">
                  <input type='text' class="form-control">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class='col-xs-6 col-md-4'>
          <div class="form-group">
            <i class="fa fa-hourglass-end fa-2x" aria-hidden="true"> Fin de votre événement</i><br><br>
            <label for="date_end" name="date_end" class="masterTooltip" title="Toutes les bonnes choses ont une fin...">Date et heure: <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
              <div class='input-group date' id='datetimepicker7' name="date_end">
                  <input type='text' class="form-control">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
  </div>
  <hr>  
  <button type="submit" id="validCreaEvent" class="btn btn-primary"><p class="glyphicon glyphicon-ok" aria-hidden="true"></p></button>
  <button type="submit" id="modifEvent" class="btn btn-primary">Modifier le formulaire</button>
</form>

<?php endif; ?>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
  <script src="<?= $this->assetUrl('js/moment.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?= $this->assetUrl('js/tooltip.js') ?>"></script>
<?php $this->stop('js') ?>