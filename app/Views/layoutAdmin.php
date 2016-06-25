<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> <!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> <!-- Font awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>"> <!-- Style Css -->


</head>
<body>
	<header>

		<!-- ma navbar -->
		<nav class="navbar navbar-default">
	  	<div class="container-fluid">
	   			<!-- Brand and toggle get grouped for better mobile display -->
	    		<div class="navbar-header">
	     			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				     </button>

	      			<a class="navbar-brand" href="<?= $this->url('default_home'); ?>">
	      			<img alt="Brand" src="<?= $this->assetUrl('img/avatar/brand1.jpg') ?>" width="100px" height="38px">
	      			</a>
	    		</div>
					<ul class="nav navbar-nav navbar-right">
			<?php if(isset($w_user) && !empty($w_user)): ?>
					<!--  searchbar -->
					<?php $this->insert('partials/searchBar') ?>
					<!-- add list -->
					<li><a href="<?= $this->url('event_createEvent');?>"><i class="glyphicon glyphicon-plus"></i></a></li>
					<!-- notifications -->
					<li><a href="#notification"><i class="glyphicon glyphicon-bell"></i></a></li>
					<!-- identité -->
				  <li><a href="#"> <?php echo $w_user['username']; ?> </a></li>
<li><a href="#"><img class="logo" style="height:2em; width: 2em; border-radius:2em;" src="<?php if(isset($w_user['avatar']) && !empty($w_user['avatar'])){echo $w_user['avatar'];}elseif(isset($w_user['url']) && !empty($w_user['url'])){echo $w_user['url']; } ?>"></a></li>

					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Votre compte <span class="caret"></span></a>
					  <ul class="dropdown-menu">
					    <li><a href="<?= $this->url('event_createEvent'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Créer un nouvel événement </a></li>
					    <li><a href="<?= $this->url('user_updateUser'); ?>"><i class="fa fa-cogs" aria-hidden="true"></i> Paramètres</a></li>
					    <li><a href="#"><i class="fa fa-medkit" aria-hidden="true"></i> Assistance </a></li>
					    <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Contactez nous </a></li>
					    <li><a href="<?= $this->url('user_logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></li>
					  </ul>
					</li>

			<?php else:  ?>
				<li><a href="<?= $this->url('event_createEvent');?>"><i class="glyphicon glyphicon-plus"></i></a></li>
				<!-- identité -->
				<li><a href="<?= $this->url('user_login'); ?>">Connectez vous</a></li>
				<li><a href="<?= $this->url('default_home'); ?>">back home</a></li>
			<?php endif;  ?>
				</ul> <!-- class="nav navbar-nav navbar-right" -->
	  </div><!-- /.container-fluid -->
	</nav>

	</header>



		<section style="background-color: #d8ddd7">
			<?= $this->section('main_content') ?>
		</section>

	</footer>



	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Boostrap Js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Moustache Js -->
	<script src="<?= $this->assetUrl('js/myscript.js') ?>"></script>
	<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
	<script src="<?= $this->assetUrl('js/typeahead.bundle.min.js') ?>"></script>
	<?= $this->section('js'); ?>
	
</body>

</html>