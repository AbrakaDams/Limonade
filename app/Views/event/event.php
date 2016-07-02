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

			<?php if(isset($roleEvent['role'])): ?>
				<?php if($roleEvent['role'] == 'event_admin'): ?>
					<a href="<?= $this->url('event_update',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button">Modifier l'évènement</a>
				<?php endif ?>
				<?php if($thisEvent['role'] == 'private' && $roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user'): ?>
					<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button">Inviter plus d'amis</a>
				<?php elseif($thisEvent['role'] == 'public' && $roleEvent['role'] == 'event_admin'): ?>
					<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button">Inviter plus d'amis</a>
				<?php endif ?>
			<?php else: ?>
				<?php if($thisEvent['role'] == 'public' && $roleEvent['role'] != 'event_admin' && $roleEvent['role'] != 'event_user'): ?>
					<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="event-invite-btn" role="button">Rejoindre</a>
				<?php endif; ?>
			<?php endif; ?>
			<hr>
				<h3 class="particip-title"> Liste des participants :</h3>
				<ul class="particip-friends-list">
					<?php
					if($participants == null){
						echo 'aucun participant';
					}
					else{
						foreach ($participants as $infos) {
							echo '<li><img src="'.$this->assetUrl('img/diabolo.svg').'" class="img-before-friend"> '.$infos['firstname'].' '.$infos['lastname'].'</li>';
							if($infos['role'] =='event_admin'){ 
								echo '(Admin)';
							}
						}
					}
					?>
				</ul>

				<?php if(count($participants) > 10) : ?>
					<span id="show-all-friends">Montrer tous</span>
				<?php endif; ?>

				<hr>

			

				<h3 class="particip-title">Mes évènements :</h3>
				<?php foreach ($userEvents as $userEvent) : ?>
					<a href="<?= $this->url('event_showEvent',  ['id' => $userEvent['id']]); ?>" class="user-events">
							<?php echo $userEvent['title'] ?>
							<?php if($userEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
								(Evènement terminé)
							<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</aside>

			<section id="event-main">

				<div id="event-info" data-event-id="<?=$thisEvent['id'];?>">

					<div class="event-data" style="background-image: url(
					<?php
						if(isset($thisEvent['avatar']) && !empty($thisEvent['avatar'])) {
							echo $thisEvent['avatar'];
						} else {
							echo $this->assetUrl('img/slider/img_slider9.jpg');
						}

					?>);">
						<div class="event-data-container">
							<!-- SHOW EVENT NAME -->
							<?php if(isset($thisEvent['title']) && !empty($thisEvent['title'])): ?>
								<h2 class="event-title"><?php echo $thisEvent['title']; ?></h2>
							<?php else: ?>
								<h2 class="event-title">L'évènement est sans nom</h2>
							<?php endif; ?>

							<!-- SHOW EVENT DESCRIPTION -->
							<?php if(isset($thisEvent['description']) && !empty($thisEvent['description'])): ?>
								<p class="event-desc"><?php echo $thisEvent['description']; ?></p>
							<?php endif; ?>

							<!-- SHOW EVENT DATE -->
							<?php if(isset($thisEvent['date_start']) && !empty($thisEvent['date_start'])): ?>
								<p class="event-date"><?php echo $thisEvent['date_start']; ?></p>
							<?php else: ?>
								<p class="event-date">La date n'est pas encore preciséee</p>
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
									<i class="fa fa-map-marker" aria-hidden="true"></i> L'adresse de l'évènement n'est communiqué que au personne ayant rejoin l'évènement.
								</p>
							<?php endif; ?>
						</div>
					</div>
					<?php if($thisEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
						<div id="event-expired">
							Attention cet évènement est maintenant terminé!
						</div>
					<?php endif; ?>
				</div>

<<<<<<< HEAD
				<?php if(isset($roleEvent['role'])):?>
					<?php if($thisEvent['role'] == 'private' && ($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user')): ?>
						<div id="event-lists">
							<div id="add-new-list">
								<button type="button" id="add-list-btn">+</button>
								<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
									<label for="add-list-input">Titre de cette liste</label>
									<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
									<input type="submit" value="Go">
								</form>
							</div>
=======
					<div id="event-lists">
						<div id="add-new-list">
							<button type="button" id="add-list-btn">+</button>
							<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
								<label for="add-list-input">Titre de cette liste</label>
								<br>
								<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
								<input type="submit" value="Go">
							</form>
>>>>>>> origin/master
						</div>
					<?php elseif($thisEvent['role'] == 'public' && $roleEvent['role'] == 'event_admin'): ?>
						<div id="event-lists">
							<div id="add-new-list">
								<button type="button" id="add-list-btn">+</button>
								<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
									<label for="add-list-input">Titre de cette liste</label>
									<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
									<input type="submit" value="Go">
								</form>
							</div>
						</div>
					<?php elseif($thisEvent['role'] == 'public' && $roleEvent['role'] == 'event_user'): ?>
						<p>
							salut
						</p>
							<div id="event-lists">
							</div>
					<?php endif; ?>
				<?php endif; ?>

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
							<p>Pour voir les commentaires rejoingné l'évenement</p>
						</div>
					<?php endif; ?>
				<?php else: ?>

				<div class="alert alert-danger">
					<p>Connectez vous pour voir les commentaires</p>
				</div>

				<?php endif; ?>
			</section>

			<aside id="event-newsfeed">
			<?php if($roleEvent['role'] == 'event_admin' || $roleEvent['role'] == 'event_user'): ?>
				<h3>Fil activités</h3>

				<?php if(isset($showNewsFeed) && !empty($showNewsFeed)): ?>
					<?php foreach ($showNewsFeed as $newsFeed): ?>
						<!-- // si list est vide et que card est rempli on affiche card
						// si card est vide et que list est rempli on affcihe list
						// si list et cards sont vide on affiche no actualiter
						// si list et card sont remplie on affiche les 2

						// Si il ne trouve rien dans id_list et qu'il trouve quelquechos dans id_card -->
						<?php if($newsFeed['id_list'] == 0  && $newsFeed['id_card'] != 0) :?>
							<div class="news">
								<?= $newsFeed['username']  ?>
								<?php switch($newsFeed['action']) {
									case 'add' :
										echo 'à ajouté';
										break;
									case 'remove' :
										echo 'à supprimé';
										break;
									case 'modify' :
										echo 'à modifié';
										break;
								} ?>
								la tache :
								<strong> <?= $newsFeed['card_title']?> </strong>,
								le : <?php echo date('d/m/Y', strtotime($newsFeed['date_news'])) . 'à' . date('H:m', strtotime($newsFeed['date_news'])); ?>
								<hr>
							</div>

						<?php elseif($newsFeed['id_list'] != 0  && $newsFeed['id_card'] == 0) :?>
							<!-- // si l'action = add alors on repond pour ce cas sinon on repondra pour le cas d'un suppression -->
							<div class="news">
								<?= $newsFeed['username']  ?>
								<?php switch($newsFeed['action']) {
									case 'add' :
										echo 'à ajouté';
										break;
									case 'remove' :
										echo 'à supprimé';
										break;
									case 'modify' :
										echo 'à modifié';
										break;
								} ?>
								la liste :
								<strong> <?= $newsFeed['list_title']?> </strong>,
								le : <?php echo date('d/m/Y', strtotime($newsFeed['date_news'])) . 'à' . date('H:m', strtotime($newsFeed['date_news'])); ?>
								<hr>
							</div>

						<?php elseif($newsFeed['id_list'] != 0  && $newsFeed['id_card'] != 0) :?>
							<!-- // si l'action = add alors on repond pour ce cas sinon on repondra pour le cas d'un suppression -->
							<div class="news">
								<?= $newsFeed['username']  ?>
								<?php switch($newsFeed['action']) {
									case 'add' :
										echo 'à ajouté';
										break;
									case 'remove' :
										echo 'à supprimé';
										break;
									case 'modify' :
										echo 'à modifié';
										break;
								} ?>
								la tache :
								<strong> <?= $newsFeed['card_title']?> </strong>,
								dans la liste : <strong><?=$newsFeed['list_title']?></strong>
								le : <?php echo date('d/m/Y', strtotime($newsFeed['date_news'])) . 'à' . date('H:m', strtotime($newsFeed['date_news'])); ?>
								<hr>
							</div>

						<?php else: ?>
							<p>
								Pas d'actualité ...
							</p>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php else: ?>
				<div class="alert alert-danger">
					<p>Pour voir le fil d'actualité rejoingné l'évenement</p>
				</div>
			<?php endif; ?>
			</aside>
		</div>
<?php else: ?>
	<p>
		Pour accéder au évènement priver il faut etre inviter par le createur ou les participant de l'évènment ! !!
	</p>
<?php endif; ?>




<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script src="<?= $this->assetUrl('js/10_lists.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/11_comment.js') ?>"></script>
<?php $this->stop('js') ?>
