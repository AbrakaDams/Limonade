<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<div class="container">
    <div class="row">

        <?php foreach ($myEvents as $value): ?>

            <div class="col-xs-12 col-sm-3 col-md-4">
                <div class="index-event" style="background-image:url('<?php if(!empty($value['event_avatar'])) {echo $value['event_avatar'];}else{echo '';} ?>');">


                    <h3><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>

                    <div class="index-event-content">
                          <!--  Petit switch pour afficher publique et non pubic et privé et non private!!! ? -->
                        <p>Type d'évènement :<strong><i><?php echo $value['category']; ?></i></strong> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                        <br>
                        <p><?php echo $value['description']; ?></p>
                          <!-- Si l'user participe a cette evenement on montre l'adresse -->
                        <p>A cette adresse : <?php echo $value['address']; ?></p>
                        <p>Date de début : <?php echo date('d/m/Y', strtotime($value['date_start'])) . ' à ' . date('H:m', strtotime($value['date_start'])); ?></p>
                        <p>Date de fin : <?php echo date('d/m/Y', strtotime($value['date_end'])) . ' à ' . date('H:m', strtotime($value['date_end'])); ?></p>
                          <!-- Si l'user participe a cette evenement on montre  un bouton je participe déja -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-xs-12 col-sm-3 col-md-4">
            <div class="column-home">
                <h2><a href="<?= $this->url('event_createEvent'); ?>"> <i class="glyphicon glyphicon-plus"></i> </a></h2>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <?php foreach ($thisEventPublic as $value): ?>


            <div class="col-xs-12 col-sm-3 col-md-4">
                <div class="index-event" style="background-image:url('<?php if(!empty($value['event_avatar'])) {echo $value['event_avatar'];}else{echo '';} ?>');">

                    <h3><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>

                    <div class="index-event-content">
                          <!--  Petit switch pour afficher publique et non pubic et privé et non private!!! ? -->
                        <p>Type d'évènement :<strong><i><?php echo $value['category']; ?></i></strong> et <strong><i><?php echo $value['role']; ?></i></strong></p>
                        <br>
                        <p><?php echo $value['description']; ?></p>
                          <!-- Si l'user participe a cette evenement on montre l'adresse -->
                        <p>A cette adresse : <?php echo $value['address']; ?></p>
                        <p>Date de début : <?php echo date('d/m/Y', strtotime($value['date_start'])) . ' à ' . date('H:m', strtotime($value['date_start'])); ?></p>
                        <p>Date de fin : <?php echo date('d/m/Y', strtotime($value['date_end'])) . ' à ' . date('H:m', strtotime($value['date_end'])); ?></p>
                          <!-- Si l'user participe a cette evenement on montre  un bouton je participe déja -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<?php $this->stop('main_content') ?>
