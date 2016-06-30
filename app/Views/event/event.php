<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

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
	</div>
	<div>
		<h3>Tous les participants de cet évènement :</h3>
		<?php
		foreach ($allparticipants as $infos) {
			echo $infos['firstname'].' '.$infos['lastname'].'<br>' ;
		}
		?>
	</div>

	<aside class="">
		<h3>Fil activités</h3>

		<?php var_dump($showNewsFeed); if(isset($showNewsFeed) && !empty($showNewsFeed)): ?>
			<?php foreach ($showNewsFeed as $newsFeed) {
				if($newsFeed['action'] === 'add'){
				echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à ajouté :<strong> '.$newsFeed['title'].'</strong> ,crée le :' .$newsFeed['date_add'].'<hr>';
			}else{
				echo $newsFeed['username'].'<img class="newsfeed-avatar" style="height:2em; width: 2em; border-radius:2em;" src="'.$newsFeed['avatar'].'"><br> à supprimer : <strong>'.$newsFeed['title'].' </strong>,crée  le :' .$newsFeed['date_add'].'<hr>';
			}
			} ?>
		<?php endif; ?>
	</aside>



	<section id="event-info" data-event-id="<?=$thisEvent['id'];?>">

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
			<p class="event-address"><?php echo $thisEvent['address']; ?></p>
		<?php else: ?>
			<p class="event-address">Adresse n'est pas encore preciséE</p>
		<?php endif; ?>
	</section>

	<section id="event-lists">



	</section>

	<div id="add-new-list">
		<button type="button" id="add-list-btn">+</button>
		<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
			<label for="add-list-input">Titre de cette liste</label>
			<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
			<input type="submit" value="Go">
		</form>
	</div>


<?php  if(isset($w_user) && !empty($w_user)):?>
	<section>

		<h3>Commentaires</h3>
		<form method="post" id="form-comment">
			<textarea name="comment" id="comment" rows="2" cols="50"></textarea>
			<input type="submit" name="submit" value="Commentez">
		</form>

		<div id="comments">


		</div>

	</section>
<?php else: ?>

<div class="alert alert-danger">
	<p>
		Connectez vous pour voir les commentaireS
	</p>
</div>
<?php endif; ?>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script src="<?= $this->assetUrl('js/10_lists.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/11_comment.js') ?>"></script>
<?php $this->stop('js') ?>
