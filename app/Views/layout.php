<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> <!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> <!-- Font awesome -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="<?= $this->assetUrl('img/avatar/lemonade_brand.jpg') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/owl.carousel.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap-datetimepicker.min.css') ?>">

	<style>
		#notification_li
		{
		position:relative
		}
		#notificationContainer
		{
		background-color: #fff;
		border: 1px solid rgba(100, 100, 100, .4);
		-webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
		overflow: visible;
		position: absolute;
		top: 4.2em;
		margin-left: -170px;
		width: 400px;
		z-index: 10;
		display: none; // Enable this after jquery implementation
		}
		// Popup Arrow
		#notificationContainer:before {
		content: '';
		display: block;
		position: absolute;
		width: 0;
		height: 0;
		color: transparent;
		border: 10px solid black;
		border-color: transparent transparent white;
		margin-top: -20px;
		margin-left: 188px;
		}
		#notificationTitle
		{
		font-weight: bold;
		padding: 8px;
		font-size: 13px;
		background-color: #ffffff;
		position: fixed;
		z-index: 1000;
		width: 384px;
		border-bottom: 1px solid #dddddd;
		}
		#notificationsBody
		{
		padding: 33px 0px 0px 0px !important;
		min-height:300px;
		}
		#notificationFooter
		{
		background-color: #e9eaed;
		text-align: center;
		font-weight: bold;
		padding: 8px;
		font-size: 12px;
		border-top: 1px solid #dddddd;
		}
		</style>
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
	      			<!-- <img alt="Brand" src="<?= $this->assetUrl('img/avatar/brand1.jpg') ?>" width="100px" height="38px"> -->
					Limonad
	      		</a>
	    	</div>
				<ul class="nav navbar-nav navbar-right">
			<?php if(isset($w_user) && !empty($w_user)): ?>
					<!--  searchbar -->
					<?php $this->insert('partials/searchBar') ?>
					<!-- add list -->
					<li><a href="<?= $this->url('event_createEvent');?>"><i class="glyphicon glyphicon-plus"></i></a></li>
					<!-- notifications -->
					<li id="notification_li">
						<a href="#notification" id="notificationLink">
							<i class="glyphicon glyphicon-bell"></i>
						</a>
						<div id="notificationContainer">
							<div id="notificationTitle">Notifications</div>
							<div id="notificationsBody" class="notifications">
								<?php foreach ($w_notifications as $notification):?>
									<a class="<?= $notification['read']?>" href="<?= $this->url('event_showEvent', ['id' => $notification['id_event']]);?>">
										<span class="notification">
											<?= $notification['content'].'<br>Le '.$notification['date_create']; ?>
										</span>
									</a><hr>
								<?php endforeach; ?>
							</div>
							<div id="notificationFooter"><a href="#">See All</a></div>
						</div>
					</li>



					<!-- identité -->
				  	<li><a href="#"> </li>
					<li><a href="#">
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<?php echo $w_user['username']; ?>
							 <img class="navbar-avatar" src="<?php if(isset($w_user['avatar']) && !empty($w_user['avatar'])){echo $w_user['avatar'];} elseif(isset($w_user['url']) && !empty($w_user['url'])) { echo $w_user['url']; } else { echo 'http://www.actionudaipur.com/static/img/no_img.jpg';} ?>"> 
							 <span class="caret"></span>
						 </a>
						<ul class="dropdown-menu">
							<li><a href="<?= $this->url('event_createEvent'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Créer un nouvel événement </a></li>
							<li><a href="<?= $this->url('user_updateUser'); ?>"><i class="fa fa-cogs" aria-hidden="true"></i> Paramètres</a></li>

							<li><a href="<?= $this->url('default_faq'); ?>"><i class="fa fa-medkit" aria-hidden="true"></i> FAQ </a></li>

							<li><a href="<?= $this->url('contact_contact'); ?>"><i class="fa fa-question-circle" aria-hidden="true"></i> Contactez nous </a></li>
							<li><a href="<?= $this->url('user_logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></li>
						</ul>
					</li>
			<?php else:  ?>
				<li><a href="<?= $this->url('event_createEvent');?>"><i class="glyphicon glyphicon-plus"></i></a></li>
				<!-- identité -->
				<li><a href="<?= $this->url('user_login'); ?>">Connectez vous</a></li>
				<li><a href="<?= $this->url('user_register'); ?>">Inscrivez-vous</a></li>
			<?php endif;  ?>
				</ul> <!-- class="nav navbar-nav navbar-right" -->
	  </div><!-- /.container-fluid -->
	</nav>

	</header>


		<section>
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
	<script src="<?= $this->assetUrl('js/moment-with-locales.min.js') ?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Moustache Js -->
	<!--script src="<?= $this->assetUrl('js/myscript.js') ?>"></script-->
	<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
	<script src="<?= $this->assetUrl('js/notifications.js') ?>"></script>

	<!-- CDN pour le datetimePicker -->
	<script src="<?= $this->assetUrl('js/bootstrap-datetimepicker.min.js');?>"></script>
	<?= $this->section('js'); ?>

</body>

</html>
