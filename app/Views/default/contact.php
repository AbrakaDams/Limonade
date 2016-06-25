<?php $this->layout('layoutContact', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>

  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?= implode('<br>', $errors); ?>
    </div>
  <?php endif; ?>
  
<!-- Formulaire de contact -->
<form id="contact" method="post">
  <h2><i class="fa fa-paper-plane" aria-hidden="true"></i></h2>
  <h2>Formulaire de contact</h2>
  <div class="row">

    <div class="col-xs-6">
      <label for="email" class="mail">Votre adresse mail :</label>    
      <input name="email" type="email" class="form-control" id="email" placeholder="Email">    
    </div>
    <div class="col-xs-6">
      <label for="name" class="name">Votre nom :</label>    
      <input name="name" type="text" class="form-control" id="name" placeholder="Nom">   
    </div>    
  </div>
  <hr>
  <div class="form-group">
    <label for="object" class="">L'objet de votre demande :</label>    
    <input name="object" type="text" class="form-control" id="object" placeholder="Objet">    
  <hr>  
    <label class="content">Votre contenu</label>
    <textarea name="content" class="form-control" rows="4" cols="3" placeholder="Votre contenu"> </textarea>
  </div>
  <br> 
  <button type="submit" class="btn btn-primary">Envoyer le formulaire</button> 
</form>

<a href="<?= $this->url('default_home') ?>"><i class="fa fa-home fa-3x" aria-hidden="true">Retour Accueil</i></a>

<?php $this->stop('main_content') ?>
