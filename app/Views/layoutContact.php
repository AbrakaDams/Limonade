<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> <!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> <!-- Font awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>"> <!-- Style Css -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>


</head>
<body>

		<section style="background-color: #d8ddd7">
			<?= $this->section('main_content') ?>
		</section>

		<footer>
			<div class="container">
				<div class="row" id="team">
					<!-- Nous suivre -->
					<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
						<div class="nc-footer-social">
							<h3 class="nc-footer-title">
								<a href="<?= $this->url('contact_contact');?>">
									<i class="fa fa-paper-plane" aria-hidden="true"></i> Nous suivre
								</a>
							</h3>


							<div class="nc-footer-icons-social">

								<a href=""><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>

								<a href=""><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>

								<a href=""><i class="fa fa-pinterest-p fa-2x" aria-hidden="true"></i></a>

								<a href=""><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>

								<a href=""><i class="fa fa-snapchat-square fa-2x" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>

					<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
						<div class="nc-footer-contact">
							<h3 class="nc-footer-title">
								<a href="#"><i class="fa fa-fort-awesome" aria-hidden="true"></i> Contact</a>
							</h3>
							<p><address><i class="fa fa-map-marker" aria-hidden="true"></i> :66 rue de l’Abbé de l’Epée<br> 33 000 Bordeaux, France</address>
							</p>
							<p><i class="fa fa-phone" aria-hidden="true"></i> (+33)05 05 28 25 46</p>
							<p><i class="fa fa-envelope" aria-hidden="true"></i> :
							team_power-ranger@best.com</p>
						</div>
					</div>

					<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
					<!-- Dossier Img -->
						<div class="nc-footer-team">
							<h3 class="nc-footer-title">
								<a href="<?= $this->url('default_team');?>"><i class="fa fa-users fa-1x" aria-hidden="true"></i> L'équipe</a>
							</h3>

							<a href="#">
								<img src="<?= $this->assetUrl('img/avatar/Anastasia.jpg') ?>" alt="avatar-team" class="nc-footer-team-img">
							</a>

							<a href="#">
								<img src="<?= $this->assetUrl('img/avatar/Damien.jpg') ?>" alt="avatar-team" class="nc-footer-team-img">
							</a>

							<a href="#">
								<img src="<?= $this->assetUrl('img/avatar/Myriam.jpg') ?>" alt="avatar-team" class="nc-footer-team-img">
							</a>

							<a href="#">
								<img src="<?= $this->assetUrl('img/avatar/Baptiste.jpg') ?>" alt="avatar-team" class="nc-footer-team-img">
							</a>

							<a href="#">
								<img src="<?= $this->assetUrl('img/avatar/Noé.jpg') ?>" alt="avatar-team" class="nc-footer-team-img">
							</a>
						</div>
					</div>
				</div> <!-- end of div.row -->
			</div> <!-- end of div.container -->

			<p class="footer-copy"><?php echo date('Y'); ?> &copy; Limonade &reg;</p>
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
