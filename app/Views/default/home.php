
<?php $this->layout('layoutNoConnect', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>


<!-- Section slider -->
<section class="slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	  	<ol class="carousel-indicators">
	    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
	  	</ol>
	  	<!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
	    	<div class="item active" ">
	      			<img src="<?= $this->assetUrl('img/slider/img_slider1.jpg') ?>" class="img-slide">
	      		<div class="carousel-caption">
							<h1  class="titleIntro">Avec <strong>Limonade</strong> stop la prise de tête pour organiser votre événements !</h1>
							<h4 class="textIntro">Posez vous, sirotez votre verre et laissez nous faire. &#9786;</h4>
	        		<h3 class="titleIntro">Un outil attractif et intuitif</h3>
		    			<p class="textIntro">Avec notre plateforme Limonade, vous pouvez gérer tous vos événements le plus simplement du monde.Pour cela nous mettons à votre disposition une interface simple et intuitif accompagné d'outils nécessaires pour mener à terme vos projets tout en gagnant du temps, de l'énergie et de l'efficacité.</p>
							<a href="<?= $this->url('user_register'); ?>" class="btn btn-default btn-lg active" role="button">S'inscrire</a>
	      		</div>
	    	</div>
	    	<div class="item">
	      		<img src="<?= $this->assetUrl('img/slider/img_slider2.jpg') ?>" class="img-slide" >
	      		<div class="carousel-caption">
	        		<h3 class="titleIntro">Une organisation d'événements</h3>
	    				<p class="textIntro">Organisez et pilotez tous vos événements de A à Z sur un même outil.<br>
	    				Pour cela Limonade est la plateforme qu'il vous faut pour vos événements.Reposez vous et laissez nous faire.</p>
							<a href="<?= $this->url('user_login'); ?>" class="btn btn-default btn-lg active" role="button">Se connecter</a>
	      		</div>
	    	</div>
	  	</div>
	  	<!-- Controls -->
	  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    	<span class="sr-only">Précédent</span>
	  	</a>
	  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    	<span class="sr-only">Suivant</span>
	  	</a>
	</div>


<?php  if(isset($w_user) && !empty($w_user)): ?>
	<br>
	<strong>Vous êtes déjà connecté(e). <br><a href="<?= $this->url('default_home') ?>">Retour Accueil espace membre</a></strong>
	<?php var_dump($w_user); ?>
<?php  else: ?>


<?php endif; ?>
</section>

<div class="event-near" style="background-color: #868786">

	<h2 class="center"> Liste des évenements public </h2>

</div>



<?php $this->stop('main_content') ?>
