
<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<body>
	<div class="container">
		<header>
			<h1>Limonade :: Plateforme d'organisation d'événements</h1>
			<h2><?= $this->e($title) ?></h2>						
		</header>

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
      						<img src="" alt="img-slide">      						
      					<div class="carousel-caption">
        					<h3>Une interface simple et intuitive</h3>
    						<p>...</p>
      					</div>
    				</div>
    				<div class="item">
      						<img src="..." alt="img-slide">
      					<div class="carousel-caption">
        					<h3>Une organisation d'événements</h3>
    						<p>...</p>
      					</div>
    				</div>
    				...
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
		</section>

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>
</body>
	
<?php $this->stop('main_content') ?>


