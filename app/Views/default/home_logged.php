<?php $this->layout('layout', ['title' => 'Accueil Connecter']) ?>

<?php $this->start('main_content') ?>

<div class="container">

    <h1 class="index-title">Mes événements</h1>
    <div class="row">

        <?php foreach ($myEvents as $value): ?>

            <div class="col-xs-12 col-sm-4">
                <div class="multiple-event" style="background-image:url('<?php if(!empty($value['event_avatar'])) {echo $value['event_avatar'];}else{echo 'http://www.salvagente.co.za/wp-content/uploads/2016/01/sparkling-bourbon-lemonade-ftr.jpg';} ?>');">

                    <span class="multiple-event-category">
                        <?php switch ($value['category']) {
                            case 'repas' :
                                echo 'répas';
                                break;
                            case 'vacances' :
                                echo 'vacances';
                                break;
                            case 'soiree' :
                                echo 'soirée';
                                break;
                            case 'journee' :
                                echo 'journée';
                                break;
                        }
                        ?>
                    </span>

                    <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>" class="multiple-event-content">
                        <!-- <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"> -->

                            <p class="multiple-event-role">
                                <?php switch($value['role']) {
                                    case 'private':
                                        echo '<i class="fa fa-lock" aria-hidden="true"></i> ' . $value['role'];
                                        break;
                                    case 'public';
                                        echo '<i class="fa fa-unlock" aria-hidden="true"></i> ' . $value['role'];
                                        break;
                                } ?>
                            </p>

                            <p class="multiple-event-date"><i class="fa fa-calendar-o" aria-hidden="true"></i> <span> du  <?php echo date('d/m/Y', strtotime($value['date_start'])) . ' à ' . date('H:m', strtotime($value['date_start'])) .
                            '<br> au ' . date('d/m/Y', strtotime($value['date_end'])) . ' à ' . date('H:m', strtotime($value['date_end'])); ?></span></p>

                            <p class="multiple-event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $value['address']; ?></p>

                              <!-- Si l'user participe a cette evenement on montre  un bouton je participe déja -->

                            <p class="multiple-event-desc"><?php echo $value['description']; ?></p>
                        <!-- </a> -->
                    </a>
                </div>

                <h3 class="multiple-event-title"><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>



            </div>
        <?php endforeach; ?>

        <div class="col-xs-12 col-sm-4">
            <a  class="index-create-event"href="<?= $this->url('event_createEvent'); ?>">Créer un nouvel événement</a>

        </div>
    </div>

    <hr>

    <h2 class="index-title">Les événements publics à participer</h2>
    <div class="row">
        <?php foreach ($thisEventPublic as $value): ?>

            <div class="col-xs-12 col-sm-4">
                <div class="multiple-event" style="background-image:url('<?php if(!empty($value['event_avatar'])) {echo $value['event_avatar'];}else{echo 'http://www.salvagente.co.za/wp-content/uploads/2016/01/sparkling-bourbon-lemonade-ftr.jpg';} ?>');">

                    <span class="multiple-event-category">
                        <?php switch ($value['category']) {
                        case 'repas' :
                            echo 'répas';
                            break;
                        case 'vacances' :
                            echo 'vacances';
                            break;
                        case 'soiree' :
                            echo 'soirée';
                            break;
                        case 'journee' :
                            echo 'journée';
                            break;
                        }
                        ?>
                    </span>

                    <a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>" class="multiple-event-content">


                            <p class="multiple-event-role">
                                <?php switch($value['role']) {
                                    case 'private':
                                        echo '<i class="fa fa-lock" aria-hidden="true"></i> ' . $value['role'];
                                        break;
                                    case 'public';
                                        echo '<i class="fa fa-unlock" aria-hidden="true"></i> ' . $value['role'];
                                        break;
                                } ?>
                            </p>

                            <p class="multiple-event-date"><i class="fa fa-calendar-o" aria-hidden="true"></i> <span> du  <?php echo date('d/m/Y', strtotime($value['date_start'])) . ' à ' . date('H:m', strtotime($value['date_start'])) .
                            '<br> au ' . date('d/m/Y', strtotime($value['date_end'])) . ' à ' . date('H:m', strtotime($value['date_end'])); ?></span></p>

                            <p class="multiple-event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $value['address']; ?></p>

                            <p class="multiple-event-desc"><?php echo $value['description']; ?></p>
                    </a>
                </div>

                <h3 class="multiple-event-title"><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>

            </div>
        <?php endforeach; ?>
    </div>

</div>


<?php $this->stop('main_content') ?>
