<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<?php foreach ($thisEventPublic as $value): ?>
  <div style="display:inline-block;" class="">
    <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
    <p>Evènement de type :<i><?php echo $value['category']; ?></i> et :<strong><i><?php echo $value['role']; ?></i></strong></p>
    <br>
    <p><?php echo $value['description']; ?></p>
    <p>Rejoint nous : <?php echo $value['address']; ?></p>
    <p>Ca commence a :<?php echo $value['date_start']; ?></p>
    <p> et fini à : <?php echo $value['date_end']; ?></p>
    <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>">Aller à l'évènement</a>
  </div>
<?php endforeach; ?>

  <div style="display:inline-block;" class="">
    <p>
      <a href="<?= $this->url('event_createEvent'); ?>">Créer un évenement</a>
    </p>
  </div>

  <br><br><hr><br><br>

<?php foreach ($thisEventPrivate as $value): ?>
  <div style="display:inline-block;" class="">
    <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
    <p>Evènement de type :<i><?php echo $value['category']; ?></i> et :<strong><i><?php echo $value['role']; ?></i></strong></p>
    <br>
    <p><?php echo $value['description']; ?></p>
    <p>Rejoint nous : <?php echo $value['address']; ?></p>
    <p>Ca commence a :<?php echo $value['date_start']; ?></p>
    <p> et fini à : <?php echo $value['date_end']; ?></p>
    <br>
    <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>">Aller à l'évènement</a>
  </div>
<?php endforeach; ?>

  <div style="display:inline-block;" class="">
    <p>
      <a href="<?= $this->url('event_createEvent'); ?>">Créer un évenement</a>
    </p>
  </div>


<?php $this->stop('main_content') ?>
