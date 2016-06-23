<?php $this->layout('layout', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>

<form class="form-create-event">

  <div class="form-group">
    <label for="">Etendue de l'événement</label>
    <select class="form-group">
    	<option>Privée</option>
    	<option>Publique</option>
    </select>
  </div>

  <div class="form-group">
    <label for=""></label>
    <input type="" class="form-control" id="" placeholder="">
  </div>

  <div class="form-group">
    <label for=""></label>
    <input type="" class="form-control" id="" placeholder="">
  </div> 

  <div class="checkbox">
    <label>
      <input type="checkbox"> 
    </label>
  </div>
  <button type="submit" class="btn btn-default"></button>
</form>








<?php $this->stop('main_content') ?>