<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> <!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> <!-- Font awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>"> <!-- Style Css -->
	<link href='https://fonts.googleapis.com/css?family=BenchNine' rel='stylesheet' type='text/css'>


</head>
<body>
	<header>

	</header>

		<section id="noConnect">
			<?= $this->section('main_content') ?>
		</section>

		<footer>
			<div class="row" id="team">
					<!-- Nous suivre -->
				<div class="col-xs-6 col-sm-4" id="social-network">
					<h2 class="center"><a href="<?= $this->url('contact_contact');?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> Contact</a></h2><br>
					<div class="icons-social">
						<i class="fa fa-facebook-official fa-5x" aria-hidden="true"></i>
						<i class="fa fa-instagram fa-5x" aria-hidden="true"></i>
				    	<i class="fa fa-pinterest-p fa-5x" aria-hidden="true"></i>
				    	<i class="fa fa-github fa-5x" aria-hidden="true"></i>
				    	<i class="fa fa-snapchat-square fa-5x" aria-hidden="true"></i>
					</div>
				</div>

		 		<div class="col-xs-6 col-sm-4">
		 		<!-- Dossier Img -->
					<h2 class="center"><a href="<?= $this->url('default_team');?>"><i class="fa fa-users fa-1x" aria-hidden="true"></i> L'équipe</a></h2><br>
					<img src="<?= $this->assetUrl('img/avatar/Anastasia.jpg') ?>" alt="avatar-team" class="img-circle">
					<img src="<?= $this->assetUrl('img/avatar/Damien.jpg') ?>" alt="avatar-team" class="img-circle">
					<img src="<?= $this->assetUrl('img/avatar/Myriam.jpg') ?>" alt="avatar-team" class="img-circle">
					<img src="<?= $this->assetUrl('img/avatar/Baptiste.jpg') ?>" alt="avatar-team" class="img-circle">
					<img src="<?= $this->assetUrl('img/avatar/Noé.jpg') ?>" alt="avatar-team" class="img-circle">
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
			</div><br>	
				<hr><p class="center" id="copy"><strong> <?php echo date('Y'); ?> &copy; Limonade &reg;</strong></p>
		</footer>



	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Boostrap Js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
</body>

</html>
