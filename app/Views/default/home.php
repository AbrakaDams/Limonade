
<?php $this->layout('layoutNoConnect', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>


<!-- Section slider -->
<section class="slider">
	<div class="owl-carousel">
			<div class="item carousel-item-1"><img class="imofront" src="<?= $this->assetUrl('img/slider/birthday.jpg') ?>" alt="food"><h1 class="promo">Un outil attractif et intuitif</h1></div>
			<div class="item carousel-item-2"><img class="imofront" src="<?= $this->assetUrl('img/slider/party.jpg') ?>" alt="food"><h1 class="promo">Une organisation d'événements</div>
			<div class="item carousel-item-3"><img class="imofront" src="<?= $this->assetUrl('img/slider/pic.jpg') ?>" alt="food"><h1 class="promo">Un événement est un fait important, un fait marquant pour vous tout comme pour nous.</h1></div>
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
<div class="infos" id="infos">
	<div class="informations" id="informations">		
		<h2>Informations</h2>
		<p>Vous souhaitez créer votre event sans vous prendre la tête? Vous êtes sur la bon site alors.<br>Avec l'aide de notre plateforme <strong>Limonade</strong> prenez en main la gestion de vos évènements.</p>
		<p>Nous sommes à votre disposition pour toutes vos questions.N'hésitez pas à nous contacter via notre <a href="<?= $this->url('contact_contact'); ?>">formulaire de contact</a>.</p>
	</div>
</div>




<?php $this->stop('main_content') ?>
