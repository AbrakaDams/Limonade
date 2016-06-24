<?php $this->layout('layoutContact', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>

<!-- Contact team de manière individuelle-->
<h1><i class="fa fa-users" aria-hidden="true"></i></h1>
<div class="row">
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Anastasia.jpg') ?>" alt="avatar-team" class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Anastasia Nikokosheva Oudin</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter moi</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Damien.jpg') ?>" alt="avatar-team" class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Damien Machado</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter moi</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Myriam.jpg') ?>" alt="avatar-team" class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Myriam Khalfi Bugnazet</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter moi</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Baptiste.jpg') ?>" alt="avatar-team" class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3>Baptiste Cousin</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter moi</a> </p>
      </div>
    </div>
  </div>
  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Noé.jpg') ?>" alt="avatar-team" class="img-circle" height="100px" width="100px">
      <div class="caption">
        <h3> Noé Champigny</h3>
        <p></p>
        <p><a href="#" class="btn btn-primary" role="button">Contacter moi</a></p>
      </div>
    </div>
  </div>
</div>

<!-- Formulaire de contact -->
<form id="contact" method="post">
  <h2><i class="fa fa-paper-plane" aria-hidden="true"></i></h2>
  <h1>Formulaire de contact</h1>
  <div class="row">
    <div class="col-xs-6">
      <label for="email" class="mail">Votre adresse mail :</label>    
      <input type="email" class="form-control" id="email" placeholder="Email">    
    </div>
    <div class="col-xs-6">
      <label for="name" class="name">Votre nom :</label>    
      <input type="text" class="form-control" id="name" placeholder="Nom">   
    </div>    
  </div>
  <hr>
  <div class="form-group">
    <label for="object" class="">L'objet de votre demande :</label>    
    <input type="text" class="form-control" id="object" placeholder="Objet">    
  </div>
    <label class="content">Votre contenu</label>
    <textarea class="form-control" rows="4" cols="3" placeholder="Votre contenu"></textarea>
    <br> 
    <button type="button" class="btn btn-primary">Envoyer le formulaire</button> 
</form>

<a href="<?= $this->url('default_home') ?>"><i class="fa fa-home fa-3x" aria-hidden="true">Retour Accueil</i></a>

<?php $this->stop('main_content') ?>
