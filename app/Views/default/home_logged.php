<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<?php foreach ($thisEventPublic as $value): ?>
    <div class="container">
        <div class="row" id="row">
            <div class="col-xs-4">
                <div class="column-home">
                  <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
                  <p>Type d'évènement :<i><?php echo $value['category']; ?></i> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                  <br>
                  <p><?php echo $value['description']; ?></p>
                  <p>A cette adresse : <?php echo $value['address']; ?></p>
                  <p>Date de début : <?php echo $value['date_start']; ?></p>
                  <p>Fin de fin : <?php echo $value['date_end']; ?></p>
                  <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>">Je participe</a>
                </div>
            </div>
<?php endforeach; ?>
            <div class="col-xs-4">
                <div class="column-home">
                    <h2> Pour créer un autre événement veuillez 
                    <a href="<?= $this->url('event_createEvent'); ?>">cliquer ici </a></h2>
                </div>
            </div>
        </div>
    </div><hr>
    
<?php foreach ($thisEventPrivate as $value): ?>
    <div class="container">
        <div class="row" id="row">
            <div class="col-xs-4">
                <div class="column-home">
                    <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
                    <p>Type d'évènement :<i><?php echo $value['category']; ?></i> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                    <br>
                    <p><?php echo $value['description']; ?></p>
                    <p>A cette adresse : <?php echo $value['address']; ?></p>
                    <p>Date de début : <?php echo $value['date_start']; ?></p>
                    <p>Fin de fin : <?php echo $value['date_end']; ?></p>
                    <br>                    
                </div>
            </div> 
<?php endforeach; ?>
        </div>
    </div>



<?php $this->stop('main_content') ?>
