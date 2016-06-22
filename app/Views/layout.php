<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> <!-- Font awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>"> <!-- Style Css -->

</head>
<body>
	<div class="container">
		<header>
			<h1>Limonade :: Stop la prise de tête pour organiser votre événements</h1>
			<h4>Posez vous, sirotez votre verre et laissez notre site faire</h4>
			<h2><?= $this->e($title) ?></h2>						
		</header>


		<section>
			<?= $this->section('main_content') ?>
		</section>

	<footer>
    	<!-- Nous contacter -->
		<div class="team">


		</div>

		<!-- Nous suivre -->
		<div class="social-network">

		</div>

	</footer>
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <!-- Jquery -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> <!-- Boostrap Js -->
</body>
</html>