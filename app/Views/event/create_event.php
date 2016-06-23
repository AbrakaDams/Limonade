<?php $this->layout('layout', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>

<form class="form-create-event">

  <div class="form-group">
    <label for="type-event">Etendue de l'événement</label><br>
      <input type="radio" name="private" id="private"><label for="private">Privée</label>
      <fieldset>Seul les personnes invitées peuvent voir l'événement, ses membres et leurs publications.</fieldset><br>
      <input type="radio" name="public" id="public"><label for="public">Publique</label>
      <fieldset>Tout le monde peut voir l'événement, ses membres et leurs publications.Et donc y participer.</fieldset><br>    
  </div>
<hr>
  <div class="form-group">
    <label for="cat-event">Catégorie d'événement</label><br>
      <input type="checkbox" name="repas" id="repas"><label for="repas">Repas</label><br>
      <input type="checkbox" name="soiree" id="soiree"><label for="soiree">Soirées</label><br>
      <input type="checkbox" name="vacances" id="vacances"><label for="vacances">Vacances</label><br>
      <input type="checkbox" name="journee" id="journee"><label for="journee">Journées</label><br>                 
  </div> 
<hr>
  <div class="form-group">
    <label for="title-event">Intitulé de l'évenement</label><br> 
      <input type="text"><br><br>
    <label for="description-event">Description de l'évenement*</label><br> 
    <textarea cols="40"></textarea>
  </div>
<hr>  
  <div class="infos-event">
    <label for="date-event">Date</label>
    <label for="heure-event">Heure</label> 
    <label for="lieu-event">Lieu</label>  
  </div>  
<hr>
  <div class="participants-event">
    <label class="who-event">Participants</label>
  </div>
<hr>  
  <button type="submit" class="btn btn-default">Créer l'event</button>
</form>


<!--

Repas participatif
Soirée déguisée
Anniversaire surprise
Vacances entre amis(séjours)
Organisation de jeux
Ateliers (belotte,couture,etc)
Sorties(plages,rando,piknik,etc)
-->




<?php $this->stop('main_content') ?>