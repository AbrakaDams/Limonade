<?php $this->layout('layoutTeam', ['title' => 'Team']) ?>

<?php $this->start('main_content') ?>



<!-- Contact team de manière individuelle-->
<div class="row" id="team-contact">
  <h1 class="center" id="titleTeam"><i class="fa fa-users fa-1x" aria-hidden="true"></i> L'équipe</h1>
  <br>
  <hr id="ligne">
  <br><br>


  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Anastasia.jpg') ?>" alt="avatar-team">
      <div class="caption">
        <p>Anastasia Nikokosheva Oudin</p>
        <br>
        <p><a href="#" class="btn btn-primary" role="button">Me contacter</a> </p>
      </div>
    </div>
  </div>

  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
        <img src="<?= $this->assetUrl('img/avatar/Damien.jpg') ?>" alt="avatar-team">
      <div class="caption">
        <p>Damien <br> Machado</p>
        <br>
        <br>
        <p><a href="#" class="btn btn-primary" role="button">Me contacter</a> </p>
      </div>
    </div>
  </div>

  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Myriam.jpg') ?>" alt="avatar-team">
      <div class="caption">
        <p>Myriam <br> Khalfi <br> Bugnazet</p><br>
        <p><a href="#" class="btn btn-primary" role="button">Me contacter</a> </p>
      </div>
    </div>
  </div>

  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Baptiste.jpg') ?>" alt="avatar-team">
      <div class="caption">
        <p>Baptiste <br> Cousin </p><br><br>
        <p><a href="#" class="btn btn-primary" role="button">Me contacter</a></p>
      </div>
    </div>
  </div>

  <div class="col-xs-10 col-md-2">
    <div class="thumbnail">
      <img src="<?= $this->assetUrl('img/avatar/Noé.jpg') ?>" alt="avatar-team">
      <div class="caption">
        <p>Noé <br> Champigny</p><br><br>
        <p><a href="#" class="btn btn-primary" role="button">Me contacter</a></p>
      </div>
    </div>
  </div>

</div>

<?php $this->stop('main_content') ?>
