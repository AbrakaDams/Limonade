<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

<!--
si $participants['role'] == event_admin et qu'il est dans l'évent

si $participants['role'] == event_user et qu'il est dans l'évent
only comment
sinon -->

<?php if(($thisEvent['role'] == 'private' && ($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user')) || $thisEvent['role'] == 'public' || ($thisEvent['role'] == 'public' && !isset($roleEvent['role']))): ?>
		<div class="event-wrapper">
			<aside id="event-particip">

				<div class="event-particip-content">



			<?php if(isset($roleEvent['role'])): ?>
				<?php if($roleEvent['role'] == 'event_admin'): ?>
					<a href="<?= $this->url('event_update',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier l'évènement</a>
					<br>
				<?php endif ?>
				<?php if($thisEvent['role'] == 'private' && $roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user'): ?>
					<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Inviter plus d'amis</a>
				<?php elseif($thisEvent['role'] == 'public' && $roleEvent['role'] == 'event_admin'): ?>
					<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> inviter plus d'amis</a>
				<?php endif ?>
			<?php else: ?>
				<?php if($thisEvent['role'] == 'public' && $roleEvent['role'] != 'event_admin' && $roleEvent['role'] != 'event_user'): ?>

					<a href="<?= $this->url('event_joinEvent',  ['id' => $thisEvent['id']]); ?>" class="join-event">Rejoindre</a>
				<?php endif; ?>
			<?php endif; ?>
			<hr>
				<h3 class="particip-title"> Liste de participants (<?= count($participants); ?>):</h3>
				<ul class="particip-friends-list">
					<?php
					if($participants == null){
						echo 'aucun participant';
					}
					else{
						foreach ($participants as $infos) {
							echo '<li><img src="'.$this->assetUrl('img/diabolo.svg').'" class="img-before-friend"> '.$infos['firstname'].' '.$infos['lastname']. ' ' . (($infos['role'] =='event_admin') ? '(admin)' : '') .'</li>';
						}
					}

					?>
				</ul>

				<hr>

				<h3 class="particip-title">Mes événements :</h3>
				<?php foreach ($userEvents as $userEvent) : ?>
					<a href="<?= $this->url('event_showEvent',  ['id' => $userEvent['id']]); ?>" class="user-events">
							<?php echo $userEvent['title'] ?>
							<?php if($userEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
								(Événement terminé)
							<?php endif; ?>
					</a>
				<?php endforeach; ?>

				</div>
			</aside>

			<section id="event-main">

				<div id="event-info" data-event-id="<?=$thisEvent['id'];?>">

					<div class="event-data" style="background-image: url(
					<?php
						if(isset($thisEvent['event_avatar']) && !empty($thisEvent['event_avatar'])) {
							echo $thisEvent['event_avatar'];
						} else {
							echo $this->assetUrl('img/slider/img_slider9.jpg');
						}

					?>);">
						<div class="event-bg-transparent"></div>
						<div class="event-data-container">

							<div class="">
								<!-- SHOW EVENT NAME -->
								<?php if(isset($thisEvent['title']) && !empty($thisEvent['title'])): ?>
									<h2 class="event-title">
										<?= $thisEvent['title']; ?>
									</h2>
								<?php else: ?>
									<h2 class="event-title">L'événement est sans nom</h2>
								<?php endif; ?>

								<!-- SHOW EVENT DESCRIPTION -->
								<?php if(isset($thisEvent['description']) && !empty($thisEvent['description'])): ?>
									<p class="event-desc"><?php echo $thisEvent['description']; ?></p>
								<?php endif; ?>



								<?php if($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user' ): ?>
									<!-- SHOW EVENT ADDRESS -->
									<?php if(isset($thisEvent['address']) && !empty($thisEvent['address'])): ?>
										<p class="event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $thisEvent['address']; ?></p>
									<?php else: ?>
										<p class="event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> L'adresse n'est pas encore précisée</p>
									<?php endif; ?>
								<?php else: ?>
									<p>
										<i class="fa fa-map-marker" aria-hidden="true"></i> L'adresse de l'événement est communiquée aux personnes ayant rejoint l'évènement.
									</p>
								<?php endif; ?>

								<p>
									<?php
									switch($thisEvent['role']) {
										case 'private':
											echo '<i class="fa fa-lock" aria-hidden="true"></i> ';
											break;
										case 'public';
											echo '<i class="fa fa-unlock" aria-hidden="true"></i> ';
											break;
									}
									?>
									Evénement
									<?php
									switch($thisEvent['role']) {
										case 'private':
											echo 'privé';
											break;
										case 'public';
											echo 'public';
											break;
									}
									?>
								</p>
							</div>


							<div>
								<!-- SHOW EVENT DATE -->
								<?php if(isset($thisEvent['date_start']) && !empty($thisEvent['date_start'])): ?>
									<p class="event-date"><?php echo date('d/m/Y',  strtotime($thisEvent['date_start'])) .' à '. date('H:m',  strtotime($thisEvent['date_start'])); ?></p>
								<?php else: ?>
									<p class="event-date">La date n'est pas encore precisée</p>
								<?php endif; ?>

								<!-- SHOW EVENT PRICE -->
								<div class="event-price-container">
									<div><span id="event-price"></span> &#8364;</div>
									par personne
								</div>
							</div>



						</div>
					</div>
					<button type="button" name="button" id="newsfeed-show-btn"><< Show actus</button>

					<?php if($thisEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
						<div id="event-expired">
							Désolé cet évènement est déjà terminé!
						</div>
					<?php endif; ?>

				</div>


				<div id="event-lists" class="ui-widget-content">

				 	<?php if($thisEvent['role'] == 'private' || ($thisEvent['role'] == 'public' && $roleEvent['role'] == 'event_admin')): ?>
						<div id="add-new-list">
							<button type="button" id="add-list-btn">+</button>
							<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
								<label for="add-list-input">Titre de cette liste</label>
								<br>
								<input type="text" name="newList" id="add-list-input" maxlength="50" placeholder="Nom de votre nouvelle liste">
								<br>
								<input type="submit" value="Créer une liste">
							</form>
						</div>

					<?php endif; ?>
				</div>

				<div class="sign-drag-line">
					<i class="fa fa-angle-double-down" aria-hidden="true"></i> Faite glissez ce panneau pour elagir votre espace de travail
				</div>


				<?php if(isset($w_user) && !empty($w_user)):?>
					<?php if($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user'): ?>
						<div id="event-comments">

							<h2>Commentaires</h2>
							<form method="post" id="form-comment">
								<textarea name="comment" id="comment"></textarea>
								<br>
								<input type="submit" name="submit" value="Laisser un commentaire">
							</form>

							<div id="comments"></div>

						</div>
					<?php else: ?>
						<div class="alert alert-danger">
							<p>Pour voir les commentaires rejoingez l'évenement</p>
						</div>
					<?php endif; ?>
				<?php else: ?>

				<div class="alert alert-danger">
					<p>Connectez vous pour voir les commentaires</p>
				</div>

				<?php endif; ?>
			</section>


			<aside class="event-newsfeed">

				<span id="newsfeed-hide-btn">Cacher <i class="fa fa-angle-double-right" aria-hidden="true"></i></span>

				<h3>Fil d'actualité</h3>

				<hr>
				<?php if($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user'): ?>
					<div id="event-newsfeed">

					</div>

				<?php else: ?>
					<div class="alert alert-danger">
						<p>Pour voir le fil d'actualité rejoingnez l'évenement</p>
					</div>
				<?php endif; ?>
			</aside>
		</div>
<?php else: ?>
	<p class="notif-event-private">
		Pour accéder à un événement privé, vous devez être invité par le créateur ou les participants de l'événement.<br>
		<a href="<?= $this->url('default_home'); ?>">Retourner à l'accueil</a>
	</p>
<?php endif; ?>




<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script src="<?= $this->assetUrl('js/10_lists.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/11_comment.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/event_verif.js') ?>"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="<?= $this->assetUrl('js/event.js') ?>"></script>
<?php $this->stop('js') ?>
