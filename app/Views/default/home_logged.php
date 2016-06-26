<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<?php foreach ($thisEvent as $value): ?>
  <div style="display:inline-block;" class="">
    <h2><?php echo $value['title']; ?></h2>
    <p>Evènement de type :<i><?php echo $value['category']; ?></i> et :<i><?php echo $value['role']; ?></i></p>
    <br>
    <p><?php echo $value['description']; ?></p>
    <p>Rejoint nous : <?php echo $value['address']; ?></p>
    <p>Ca commence a :<?php echo $value['date_start']; ?></p>
    <p> et fini à : <?php echo $value['date_end']; ?></p>
  </div>
<?php endforeach; ?>

  <div style="display:inline-block;" class="">
    <p>
      <a href="<?= $this->url('event_createEvent'); ?>">Créer un évenement</a>
    </p>
  </div>

  <br><br><hr><br><br>

<?php foreach ($thisEvent as $value): ?>
  <div style="display:inline-block;" class="">
    <h2><?php echo $value['title']; ?></h2>
    <p>Evènement de type :<i><?php echo $value['category']; ?></i> et :<i><?php echo $value['role']; ?></i></p>
    <br>
    <p><?php echo $value['description']; ?></p>
    <p>Rejoint nous : <?php echo $value['address']; ?></p>
    <p>Ca commence a :<?php echo $value['date_start']; ?></p>
    <p> et fini à : <?php echo $value['date_end']; ?></p>
  </div>
<?php endforeach; ?>

  <div style="display:inline-block;" class="">
    <p>
      <a href="<?= $this->url('event_createEvent'); ?>">Créer un évenement</a>
    </p>
  </div>


<?php $this->stop('main_content') ?>
