<?php $this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<h1 style="text-align: center;">404. Perdu ?</h1>
<p style="text-align: center;">
    <strong>
        <a  href="<?= $this->url('default_home') ?>">Retour Accueil</a>
    </strong>
</p>
<?php $this->stop('main_content'); ?>
