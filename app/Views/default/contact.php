<?php $this->layout('layout', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>
 <a href="<?= $this->url('default_home') ?>">
    <i class="fa fa-home fa-1x" aria-hidden="true">
        Retour Accueil
    </i>
    </a>
<!-- Formulaire de contact -->
<div class="my-form-contact">
    <form id="contact" method="post">
        <h2 class="center"><i class="fa fa-paper-plane" aria-hidden="true"></i> Formulaire de contact</h2><br>

    <?php if(!empty($errors)): ?>

        <div class="alert alert-danger">

    <?= implode('<br>', $errors); ?>

        </div>

    <?php endif; ?>

    <?php if(isset($success) && $success === true): ?>

    <div class="alert alert-success">
        <p>Votre message a bien été pris en compte.</p>
    </div>

    <?php endif; ?>

        <div class="col-xs-6">
            <label for="email" class="mail">Votre email :</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email">
            <hr id="crazystupid-line">
        </div>
        <div class="col-xs-6">
            <label for="name" class="name">Votre nom :</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Nom">
            <hr id="crazystupid-line">
        </div>
     <br>
        <div class="form-group">
            <label for="object" class="">L'objet de votre demande :</label>
            <input name="object" type="text" class="form-control" id="object" placeholder="Objet">
        <hr>
            <label class="content">Votre contenu :</label>
            <textarea name="content" class="form-control" rows="4" cols="3" placeholder="Votre contenu"> </textarea>
        </div><br>
        <button type="submit" class="btn btn-primary">Envoyer le formulaire</button> &nbsp;
    </form>
</div>

<?php $this->stop('main_content') ?>
