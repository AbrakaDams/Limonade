
<?php $this->layout('layoutNoConnect', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>


<!-- Section slider -->
<section class="slider">
	<div class="owl-carousel">
			<div class="item carousel-item-1"><img class="imofront" src="<?= $this->assetUrl('img/slider/img_slider7.jpg') ?>" alt="food"><h1 class="promo">La joie d'un évènement bien organisé.</h1></div>
			<div class="item carousel-item-2"><img class="imofront" src="<?= $this->assetUrl('img/slider/img_slider9.jpg') ?>" alt="food"><h1 class="promo">Une organisation d'événements.</div>
			<div class="item carousel-item-3"><img class="imofront" src="<?= $this->assetUrl('img/slider/img_slider11.jpg') ?>" alt="food"><h1 class="promo">Un événement est un fait important, un fait marquant pour vous tout comme pour nous.</h1></div>
			<div class="item carousel-item-4"><img class="imofront" src="<?= $this->assetUrl('img/slider/img_slider5.jpg') ?>" alt="food"><h1 class="promo">Jetez-vous à l'eau et rejoignez Limonade.</div>
			<div class="item carousel-item-5"><img class="imofront" src="<?= $this->assetUrl('img/slider/img_slider4.jpg') ?>" alt="food"><h1 class="promo">Détendez vous, on s'occupe de tout.</h1></div>
	</div>
	<div class="connect-sub">
		<a href="<?= $this->url('user_login'); ?>">Connectez-vous</a>&nbsp;&nbsp; &nbsp;  ou <a href="<?= $this->url('user_register'); ?>">Inscrivez-vous</a>
	</div>

</section>


<div class="event-public" id="eventPublic">
	<h1 class="center"> Liste des évenements public</h1><hr>
		<?php foreach ($thisEvent as $value): ?>
  	<div class="event">
	    <h2><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h2>
	    <p>Evènement de type :<i><?php echo $value['category']; ?></i> et :<i><?php echo $value['role']; ?></i></p>
	    <br>
	    <p><?php echo $value['description']; ?></p>
	    <p>Ou? <?php echo $value['address']; ?></p>
	    <p>Commençe le :<?php echo $value['date_start']; ?></p>
	    <p>Fini le : <?php echo $value['date_end']; ?></p>
	    <a href="<?= $this->url('user_register'); ?>">S'inscrire</a>
  	</div>
	<?php endforeach; ?>
</div>
<hr>

<div class="infos" id="infos">
	<div class="informations" id="informations">		
		<h1 class="center">Informations</h1><hr>
		<p>Vous souhaitez créer votre event sans vous prendre la tête? Vous êtes sur le bon site alors.<br>Avec l'aide de notre plateforme <strong>Limonade</strong> prenez en main la gestion de tous vos évènements.<br>
		Un évènement est un fait important, un fait marquant pour vous tout comme pour nous.Il peut s'agir d'une soirée d'anniversaire pour votre enfant, une après-midi jeux de sociétés avec des inconnus afin de rencontrer de nouvelles personnes ou une journée à la plage avec vos amis.Tout le monde peut être concerné.<br>Organiser un évènement n'est pas toujours de tout repos à organiser, à gérer alors que ce doit être un moment de détente.
		Pour cela notre plateforme vous propose des outils simples, et intuitifs pour la gestion de vos évènements.<br>Nous ne sommes pas une agence d'organisation d'évènements, nous mettons seulement à votre disposition une interface simple et intuitif pour que vos évènements soit simple à organiser, et que vous passiez un bon moment en compagnie de ceux qui vous sont chers.
		<br>Avec une bonne maîtrise de notre plateforme vous pouvez créer de grands moments avec vos amis, dans votre vie tout en gagnant du temps, de l'énergie et l'efficacité.
		</p>
		<p>Nous sommes à votre disposition pour toutes vos questions.N'hésitez pas à nous contacter via notre <a href="<?= $this->url('contact_contact'); ?>">formulaire de contact</a>.</p>
		<p>Si vous souhaitez rejoindre cette plateforme,<a href="<?= $this->url('user_register'); ?>">inscrivez-vous</a>, nous vous attendons.<br>
		A très vite sur notre site.<br>
		<br>Salutations de toute l'équipe de Limonade</p>
	</div>
</div>


<?php $this->stop('main_content') ?>
