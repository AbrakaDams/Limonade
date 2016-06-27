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

		<section style="background-color: #d8ddd7">
			<?= $this->section('main_content') ?>
		</section>

		<footer>
			<div class="row" id="team">
					<!-- Nous suivre -->
				<div class="col-xs-6 col-sm-4" id="social-network">
					<h2 class="center"><a href="<?= $this->url('contact_contact');?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> Contact</a></h2><br>
					<div class="icons-social">
						<a href=""><i class="fa fa-facebook-official fa-4x" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-instagram fa-4x" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-pinterest-p fa-4x" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-github fa-4x" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-snapchat-square fa-4x" aria-hidden="true"></i></a>
					</div>
				</div>

				<div class="col-xs-6 col-sm-4">
				<!-- Dossier Img -->
				<br>
				<a href="<?= $this->url('default_home') ?>" class="center"><i class="fa fa-home fa-3x" aria-hidden="true"><strong>Accueil</strong></i></a>
				<br><br>
				<ul class="listTeam">
					<li><a href="<?= $this->url('user_login'); ?>"><strong>Connectez-vous</strong></a></li>
					<li><a href="<?= $this->url('user_register'); ?>"><strong>Inscrivez-vous</strong></a></li>
					<li><a href="<?= $this->url('event_createEvent'); ?>"> <i class="fa fa-plus" aria-hidden="true"></i><strong> Créer un nouvel événement</strong> </a></li>
					<li><a href="<?= $this->url('user_updateUser'); ?>"> <i class="fa fa-cogs" aria-hidden="true"></i><strong> Paramètres</strong></a></li>
					<li><a href="#"><i class="fa fa-medkit" aria-hidden="true"></i><strong> Assistance </strong></a></li>
				</ul>
				</div>

				<div class="col-xs-6 col-sm-4" id="local">
					<h2 class="center"><a href="#"><i class="fa fa-fort-awesome" aria-hidden="true"></i> Informations</a></h2><br>
					<p><i class="fa fa-map-marker" aria-hidden="true"></i> :
					66 rue de l’Abbé de l’Epée<br>
					33 000 Bordeaux, France</p>
					<p><i class="fa fa-phone" aria-hidden="true"></i> :
					(+33)05 05 28 25 46</p>
					<p><i class="fa fa-envelope" aria-hidden="true"></i> :
					team_power-ranger@best.com</p>
				</div>
			</div>
			<br>
				<hr id="ligne"><p class="center" id="copy"><strong> <?php echo date('Y'); ?> &copy; Limonade &reg;</strong></p>
		</footer>



	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Boostrap Js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Moustache Js -->
	<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
	<script src="<?= $this->assetUrl('js/myscript.js') ?>"></script>
</body>

</html>
