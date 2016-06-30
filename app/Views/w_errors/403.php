<?php $this->layout('layoutNoConnect', ['title' => 'Nothing to see here']) ?>

<?php $this->start('main_content'); ?>
<h1 style="text-align: center;">403. Nothing to see here.</h1>
<p style="text-align: center;">
    <strong>
        <a  href="<?= $this->url('default_home') ?>">Retour Accueil</a>
    </strong>
</p>
<?php $this->stop('main_content'); ?>
