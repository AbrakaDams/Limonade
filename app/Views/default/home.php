
<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<section class="slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	  	<ol class="carousel-indicators">
	    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    	<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	  	</ol>
	  	<!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
	    	<div class="item active">
	      			<img src="../public/assets/img/img_slider.jpg" alt="img-slide">      						
	      		<div class="carousel-caption">
	        		<h3>Un outil attractif et intuitif</h3>
	    			<p>Gagnez du temps, de l'énergie et de l'efficacité.</p>
	      		</div>
	    	</div>
	    	<div class="item">
	      			<img src="../public/assets/img/img_slider1.jpg" alt="img-slide">
	      		<div class="carousel-caption">
	        		<h3>Une organisation d'événements</h3>
	    			<p>Organisez et pilotez tous vos événements de A à Z sur un même outil.</p>
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
	    	<fieldset>	    		
	      		Avec notre plateforme Limonade, vous pouvez gérer tous vos événements le plus simplement du monde.Pour cela nous mettons à votre disposition une interface simple et intuitif accompagné d'outils nécessaires pour mener à terme vos projets tout en gagnant du temps, de l'énergie et de l'efficacité.
	      		Pour cela Limonade est la plateforme qu'il vous faut pour vos événements.Reposez vous et laissez nous faire.
	      		La bise de toute l'équipe Limonade!
	    	</fieldset>
	<a href="#" class="btn btn-primary btn-lg active" role="button">Inscription</a>
	<a href="#" class="btn btn-default btn-lg active" role="button">Connexion</a>	
</section>
<!-- Partie pour afficher les event à proximité -->
<section class="event-near">

</section>
		
	
<?php $this->stop('main_content') ?>


