<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<div class="container">
    <div class="row">

        <?php foreach ($myEvents as $value): ?>
            <div class="col-xs-4">
                <div class="column-home">
                  <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
                  <!--  Petit switch pour afficher publique et non pubic et privé et non private!!! ? -->
                  <p>Type d'évènement :<strong><i><?php echo $value['category']; ?></i></strong> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                  <br>
                  <p><?php echo $value['description']; ?></p>
                  <!-- Si l'user participe a cette evenement on montre l'adresse -->
                  <p>A cette adresse : <?php echo $value['address']; ?></p>
                  <p>Date de début : <?php echo $value['date_start']; ?></p>
                  <p>Fin de fin : <?php echo $value['date_end']; ?></p>
                  <!-- Si l'user participe a cette evenement on montre  un bouton je participe déja -->
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-xs-4">
            <div class="column-home">
                <h2><a href="<?= $this->url('event_createEvent'); ?>"> <i class="glyphicon glyphicon-plus"></i> </a></h2>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <?php foreach ($thisEventPublic as $value): ?>

            <div class="col-xs-4">
                <div class="column-home">
                    <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
                    <!--  Petit switch pour afficher publique et non pubic et privé et non private!!! ? -->
                    <p>Type d'évènement :<strong><i><?php echo $value['category']; ?></i></strong> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                    <br>
                    <p><?php echo $value['description']; ?></p>
                    <!-- Si l'user participe a cette evenement on montre l'adresse -->
                    <p>A cette adresse : <?php echo $value['address']; ?></p>
                    <p>Date de début : <?php echo $value['date_start']; ?></p>
                    <p>Fin de fin : <?php echo $value['date_end']; ?></p>
                    <!-- Dire pourquoi ou comment participé a un event private -->
                    <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>">Je participe déjà à cet évènement</a>
                    <br>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<?php $this->stop('main_content') ?>
