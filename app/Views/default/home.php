
<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<!-- Section slider -->
<section class="slider">
	<div class="owl-carousel">
		<div class="item carousel-item-1">
			<img class="slider-img" src="<?= $this->assetUrl('img/slider/img_slider7.jpg') ?>" alt="food">
			<h3 class="slider-phrase">La joie d'un évènement bien organisé.</h3>
		</div>
		<div class="item carousel-item-2">
			<img class="slider-img" src="<?= $this->assetUrl('img/slider/img_slider9.jpg') ?>" alt="food">
			<h3 class="slider-phrase">Une organisation d'événements.</h3>
		</div>
		<div class="item carousel-item-3">
			<img class="slider-img" src="<?= $this->assetUrl('img/slider/img_slider11.jpg') ?>" alt="food">
			<h3 class="slider-phrase">Un événement est un fait important, un fait marquant pour vous tout comme pour nous.</h3>
		</div>
		<div class="item carousel-item-4">
			<img class="slider-img" src="<?= $this->assetUrl('img/slider/img_slider5.jpg') ?>" alt="food">
			<h3 class="slider-phrase">Jetez-vous à l'eau et rejoignez Limonade.</h3>
			</div>
		<div class="item carousel-item-5">
			<img class="slider-img" src="<?= $this->assetUrl('img/slider/img_slider4.jpg') ?>" alt="food">
			<h3 class="slider-phrase">Détendez vous, on s'occupe de tout.</h3>
		</div>
	</div>

	<!-- bla transparent line at the bottom of slider  -->
	<div class="connect-sub">
		<a href="<?= $this->url('user_login'); ?>">Connectez-vous</a>&nbsp;&nbsp; &nbsp;  ou <a href="<?= $this->url('user_register'); ?>">Inscrivez-vous</a>
	</div>
</section>

<section id="index-guide">
	<div class="container">
		<h2 class="index-guide-title"> PRATIQUE !</h2>
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-3">
				<div class="index-guide-box">
					<a href="<?= $this->url('event_createEvent');?>"><i class="fa fa-4x fa-plus-square index-guide-icon" aria-hidden="true"></i></a>
					<h3 class="index-guide-box-title">1. Créer</h3>
					<p class="index-guide-desc">
						Créez simplement votre événement.
					</p>
				</div>
			</div>

			<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-3">
				<div class="index-guide-box">
					<i class="fa fa-4x fa-users index-guide-icon" aria-hidden="true"></i>
					<h3 class="index-guide-box-title">2. Inviter </h3>
					<p class="index-guide-desc">
						Invitez des amis à vous rejoindre pour plannifier.
					</p>
				</div>
			</div>

			<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-3">
				<div class="index-guide-box">
					<i class="fa fa-4x fa-sitemap index-guide-icon" aria-hidden="true"></i>
					<h3 class="index-guide-box-title">3. Communiquer </h3>
					<p class="index-guide-desc">
						Organisez tous ensemble votre projet.
					</p>
				</div>
			</div>

			<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-0 col-md-3">
				<div class="index-guide-box">
					<i class="fa fa-4x fa-beer index-guide-icon" aria-hidden="true"></i>
					<h3 class="index-guide-box-title">4. Profiter </h3>
					<p class="index-guide-desc">
						Profitez d'un événement parfaitement organisé.
					</p>
				</div>
			</div>

		</div>	<!-- end of div.row -->
	</div> <!-- end of div.container -->
</section>


<section id="index-events">
	<div class="container">
		<h2>Venez découvrir les prochains événements.</h2>

		<div class="row">
			<?php foreach ($thisEvent as $value): ?>
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

	                    <div href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>" class="multiple-event-content">

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

	                        <p class="multiple-event-date"><i class="fa fa-calendar-o" aria-hidden="true"></i> <span> du  <?php echo date('d/m/Y', strtotime($value['date_start'])).
	                        '<br> au ' . date('d/m/Y', strtotime($value['date_end'])); ?></span></p>

	                        <p class="multiple-event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> Vous devez vous connecter pour voir l'adresse.</p>

	                        <p class="multiple-event-desc"><?php echo (strlen($value['description']) > 100) ?  substr($value['description'], 0, 100).'...' :  $value['description']; ?></p>

							<a href="<?= $this->url('user_register'); ?>" class="index-event-btn">Je participe!</a>
	                    </div>
	                </div>

	                <h3 class="multiple-event-title"><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>

			  	</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>


<?php $this->stop('main_content') ?>
