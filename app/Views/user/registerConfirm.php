<?php $this->layout('layout', ['title' => 'Confirmation d\'email']) ?>

<?php $this->start('main_content') ?>

<div class="alert alert-success" style="text-align:center;" role="alert">
    Bravo, vous avez bien confirmé votre email
    <br> pour vous connecter cliquer<a href="<?= $this->url('user_login') ?>"> ici!</a>
</div>

<?php $this->stop('main_content') ?>
