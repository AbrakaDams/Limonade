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
			<h4>Posez vous, sirotez votre verre et laissez notre site faire &#9786;</h4>
			<h2><?= $this->e($title) ?></h2>						
		</header>


		<section>
			<?= $this->section('main_content') ?>
		</section>

	<footer>
    	<!-- 
    	Nous contacter
    	L'idée est d'avoir une photo de nous individuellement qui nous amènera sur la page pour Contactez nous
    	-->
		<div class="team">
			<h2>L'équipe</h2>
			<a href=""><img src="" alt="avatar-team" class="img-circle" height="40px" width="40px"></a>
			<a href=""><img src="" alt="avatar-team" class="img-circle" height="40px" width="40px"></a>
			<a href=""><img src="" alt="avatar-team" class="img-circle" height="40px" width="40px"></a>
			<a href=""><img src="../public/assets/img/avatar/baptiste.jpg" alt="avatar-team" class="img-circle" height="40px" width="40px"></a>
			<a href=""><img src="" alt="avatar-team" class="img-circle" height="40px" width="40px"></a>
		</div>

		<!-- Nous suivre -->
		<div class="social-network">
			<h2>Retrouvez-nous sur :</h2>
			<div class="icons-social">
    			<i class="fa fa-facebook-official" aria-hidden="true">Facebook</i>
				<i class="fa fa-instagram" aria-hidden="true">Instagram</i>    			
    			<i class="fa fa-pinterest-p" aria-hidden="true">Pinterest</i>
    			<i class="fa fa-github" aria-hidden="true">Github</i>
			</div>
		</div>
		<p><?php echo date('Y'); ?> &copy; Limonade &reg;</p>
	</footer>
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <!-- Jquery -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> <!-- Boostrap Js -->
</body>
</html>