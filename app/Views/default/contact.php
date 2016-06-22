<?php $this->layout('layout', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>


<div class="row">
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="../public/assets/img/avatar/Anastasia.jpg" alt="..." class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Anastasia Nikokosheva Oudin</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="../public/assets/img/avatar/Damien.jpg" alt="..." class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Damien Machado</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="../public/assets/img/avatar/Myriam.jpg" alt="..." class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Myriam Khalfi Bugnazet</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="../public/assets/img/avatar/Baptiste.jpg" alt="..." class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Baptiste Cousin</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="../public/assets/img/avatar/Noé.jpg" alt="..." class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3> Noé Champigny</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> </p>
      </div>
    </div>
  </div>
</div>
<a href="<?= $this->url('default_home') ?>">Retour Accueil</a>

<?php $this->stop('main_content') ?>
