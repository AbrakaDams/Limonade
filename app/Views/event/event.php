<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

<div class="event-wrapper">
	<aside id="event-particip">
		<div>
			<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="btn btn-default btn-lg active" role="button">Inviter des amis</a>
		</div>

		<div>
			<h3> Liste des participants :</h3>

			<?php
			if($participants == null){
				echo 'aucun participant';
			}
			else{
				foreach ($participants as $infos) {
					echo $infos['firstname'].' '.$infos['lastname'].'<br>' ;
				}
			}
			?>

			<h3>Mes évènements :</h3>
			<?php foreach ($userEvents as $userEvent) : ?>
				<a href="<?= $this->url('event_showEvent',  ['id' => $userEvent['id']]); ?>">
					<?php echo $userEvent['title'] ?>
						<?php if($userEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
							(Evènement terminé)
						<?php endif ?>
					<br>
				</a>
			<?php endforeach ?>
		</div>
	</aside>

	<section id="event-main">

		<div id="event-info" data-event-id="<?=$thisEvent['id'];?>">

			<div class="event-data" style="background-image: url(
			<?php
			switch ($thisEvent['category']) {
				case 'soiree' :
					echo $this->assetUrl('img/slider/img_slider7.jpg');
					break;
				case 'vacances' :
					echo $this->assetUrl('img/slider/img_slider9.jpg');
					break;
				case 'repas' :
					echo $this->assetUrl('img/slider/img_slider11.jpg');
					break;
				case 'journee' :
					echo $this->assetUrl('img/slider/img_slider5.jpg');
					break;
			}
			?>);">
				<?php if($thisEvent['date_end'] < date("Y-m-d H:i:s")) : ?>
					<div id="event-expired">
					Attention cet évènement est maintenant terminé!
					</div>
				<?php endif; ?>
				<div class="event-data-container">
					<!-- SHOW EVENT NAME -->
					<?php if(isset($thisEvent['title']) && !empty($thisEvent['title'])): ?>
						<h2 class="event-title"><?php echo $thisEvent['title']; ?></h2>
					<?php else: ?>
						<h2 class="event-title">Event sans nom</h2>
					<?php endif; ?>

					<!-- SHOW EVENT DESCRIPTION -->
					<?php if(isset($thisEvent['description']) && !empty($thisEvent['description'])): ?>
						<p class="event-desc"><?php echo $thisEvent['description']; ?></p>
					<?php endif; ?>

					<!-- SHOW EVENT DATE -->
					<?php if(isset($thisEvent['date_start']) && !empty($thisEvent['date_start'])): ?>
						<p class="event-date"><?php echo $thisEvent['date_start']; ?></p>
					<?php else: ?>
						<p class="event-date">Date n'est pas encore precisée</p>
					<?php endif; ?>

					<!-- SHOW EVENT ADDRESS -->
					<?php if(isset($thisEvent['address']) && !empty($thisEvent['address'])): ?>
						<p class="event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $thisEvent['address']; ?></p>
					<?php else: ?>
						<p class="event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> Adresse n'est pas encore precisé</p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div id="event-lists">

		</div>

		<div id="add-new-list">
			<button type="button" id="add-list-btn">+</button>
			<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
				<label for="add-list-input">Titre de cette liste</label>
				<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
				<input type="submit" value="Go">
			</form>
		</div>


		<?php  if(isset($w_user) && !empty($w_user)):?>
			<div id="event-comments">

				<h2>Commentaires</h2>
				<form method="post" id="form-comment">
					<textarea name="comment" id="comment"></textarea>
					<input type="submit" name="submit" value="Commentez">
				</form>

				<div id="comments"></div>

			</div>
		<?php else: ?>

		<div class="alert alert-danger">
			<p>Connectez vous pour voir les commentaires</p>
		</div>

		<?php endif; ?>
	</section>

	<aside id="event-newsfeed">
		<h3>Fil activités</h3>
		<?php if(isset($showNewsFeed) && !empty($showNewsFeed)): ?>
			<?php foreach ($showNewsFeed as $newsFeed) {
				// si list est vide et que card est rempli on affiche card
				// si card est vide et que list est rempli on affcihe list
				// si list et cards sont vide on affiche no actualiter
				// si list et card sont remplie on affiche les 2

				// Si il ne trouve rien dans id_list et qu'il trouve quelquechos dans id_card
				if($newsFeed['id_list'] == 0  && $newsFeed['id_card'] != 0) {
					// si l'action = add alors on repond pour ce cas sinon on repondra pour le cas d'un suppression
					if($newsFeed['action'] === 'add'){
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à ajouté la tache :<strong> '.$newsFeed['card_title'].'</strong> ,crée le :' .$newsFeed['date_news'].'<hr>';
					}else{
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à supprimer la tache : <strong>'.$newsFeed['card_title'].' </strong>,crée  le :' .$newsFeed['date_news'].'<hr>';
					}
				}
				// Si il ne trouve rien dans id_card et qu'il trouve quelquechos dans id_list
				if($newsFeed['id_list'] != 0 && $newsFeed['id_card'] == 0) {
					// si l'action = add alors on repond pour ce cas sinon on repondra pour le cas d'un suppression
					if($newsFeed['action'] === 'add'){
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à ajouté la liste :<strong> '.$newsFeed['list_title'].'</strong> ,crée le :' .$newsFeed['date_news'].'<hr>';
					}else{
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à supprimer la list : <strong>'.$newsFeed['list_title'].' </strong>,crée  le :' .$newsFeed['date_news'].'<hr>';
					}
				}
				// Si il  trouve quelque chos dans les 2 id si desous
				if($newsFeed['id_list'] != 0 && $newsFeed['id_card'] != 0) {
					// si l'action = add alors on repond pour ce cas sinon on repondra pour le cas d'un suppression
					if($newsFeed['action'] === 'add'){
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à ajouté la liste :<strong> '.$newsFeed['list_title'].'</strong> ,crée le :' .$newsFeed['date_news'].'<hr>';
						echo '<br> à ajouté la tache :<strong> '.$newsFeed['card_title'].'</strong> ,crée le :' .$newsFeed['date_news'].'<hr>';
					}else{
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à supprimer la list : <strong>'.$newsFeed['list_title'].' </strong>,crée  le :' .$newsFeed['date_news'].'<hr>';
						echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à supprimer la tache : <strong>'.$newsFeed['card_title'].' </strong>,crée  le :' .$newsFeed['date_news'].'<hr>';
					}
				}
			} ?>
		<?php else: ?>
			<p>
				Pas d'actualité ...
			</p>
		<?php endif; ?>
	</aside>

</div> <!-- end of div.event-wrapper -->





<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script src="<?= $this->assetUrl('js/10_lists.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/11_comment.js') ?>"></script>
<?php $this->stop('js') ?>
