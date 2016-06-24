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
<hr>
<form class="form-create-event">
  <div class="form-group">
    <label for="type-event">Etendue de l'événement</label><br>
      <input type="radio" name="role" id="private" value="private"><label for="private">Privée</label>
      <fieldset>Seul les personnes invitées peuvent voir l'événement, ses membres et leurs publications.</fieldset><br>
      <input type="radio" name="role" id="public" value="public"><label for="public">Publique</label>
      <fieldset>Tout le monde peut voir l'événement, ses membres et leurs publications.Et donc y participer.</fieldset><br>
  </div>

  <hr>
  <div class="form-group">
    <label for="cat-event">Catégorie d'événement</label><br>
      <input type="radio" name="category" value="repas" id="repas"><label for="repas">Repas</label><br>
      <input type="radio" name="category" value="soiree" id="soiree"><label for="soiree">Soirées</label><br>
      <input type="radio" name="category" value="vacances" id="vacances"><label for="vacances">Vacances</label><br>
      <input type="radio" name="category" value="journee" id="journee"><label for="journee">Journées</label><br>
  </div>

  <hr>
  <div class="form-group">
    <label for="title-event">Intitulé de l'événement:</label><br>
      <input type="text" name="title" placeholder="Le titre de votre évenement..."><br><br>
    <label for="description-event">Description de l'évenement:</label><br>
    <textarea value="description" cols="40" placeholder="Une brève description de votre événement ?"></textarea>
  </div>

  <hr>
  <div class="row">
    <div class="col-xs-6 .col-md-4">      
      <label for="lieu-event">Adresse de l'événement:</label><br>        
        <input type="text" name="adress" value="adress" placeholder="Votre adresse"><br><br>
    </div><br>
    <div class="col-xs-6 .col-md-4">
      <label for="date_begin">Date du début l'événement:</label><br>
      <input type="date" name="date">
    </div><br><br>
    <br>
    <div class="col-xs-6 .col-md-4">
      <label for="date_end">Date de la fin l'événement:</label><br>
      <input type="date" name="date">
    </div><br><br>
    <br><br><br>
    <div class="col-xs-6 .col-md-4">
      <label class="who-event">Participants:</label><br>
      <textarea cols="40" placeholder="..."></textarea>
    </div>
  </div>
  <br><hr>
  <button type="submit" class="btn btn-default"><strong>Créer l'événement</strong></button>
</form>

<?php endif; ?>

<!-- Repas participatif
     Soirée déguisée
     Anniversaire surprise
     Vacances entre amis(séjours)
     Organisation de jeux
     Ateliers (belotte,couture,etc)
     Sorties(plages,rando,piknik,etc) -->

<?php $this->stop('main_content') ?>
