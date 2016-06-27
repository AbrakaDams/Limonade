<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

	<?php echo '<span id="event-info">' .$thisEvent['id'].'</span>'; ?>

	<div>
		<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="btn btn-default btn-lg active" role="button">Inviter des amis</a>
	</div>
	<aside class="">
		<h3>Fil activités</h3>
		<?php var_dump($newsFeed); ?>
	</aside>

	<section id="event-info">
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
			<p class="event-address">Adresse n'est pas encore precisé</p>
		<?php endif; ?>
	</section>

	<section id="event-lists">
		<?php if(isset($lists) && !empty($lists)): ?>
			<ul>
				<?php foreach ($lists as $value): ?>
					<li><?php echo $value['title']; ?></li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>
		<div id="response"></div>
		<div class="add-new-card">
			<form class="add-card-form" action="<?=$this->url('list_addCard');?>" method="post">
				<label>Titre de cette tache</label>
				<input type="text" name="card_title" maxlength="150" placeholder="Nom de votre nouvelle card">
				<br>

				<label for="">Description</label>
				<textarea name="card_desc" rows="8" cols="40"></textarea>
				<br>

				<label for="">Quantite</label>
				<input type="number" name="card_quantity">
				<br>

				<label for="">Prix</label>
				<input type="number" name="card_price">
				<br>


				<label for="">Responsable</label>
				<select name="card_person">
					<option value="0">Choisir</option>
					<?php
						foreach ($participants as $key => $value) {
							echo '<option value ="'.$value['id'].'">'.$value['username'].'</option>';
						}
					 ?>
				</select>
				<br>

				<input type="submit" value="Go">
			</form>
		</div>

		<div id="add-new-list">
			<button type="button" id="add-list-btn">+</button>
			<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
				<label for="add-list-input">Titre de ce liste</label>
				<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
				<input type="submit" value="Go">
			</form>
		</div>

	</section>




<?php  if(isset($w_user) && !empty($w_user)):?>
	<section>
		<h3>Commentaire</h3>
		<form method="post">
			<textarea name="comment" rows="2" cols="50"></textarea>
			<input type="submit" name="submit" value="Commentez">
		</form>
		<div class="">
			<?php foreach ($showComments as $value): ?>
				<div style="border-radius: 5px; background-color: rgb(163, 161, 208);" class="">
					<img class="logo" style="height:2em; width: 2em; border-radius:2em;" src="
					<?php if(isset($value['avatar']) && !empty($value['avatar'])){ echo $value['avatar'];}
					elseif(isset($value['url']) && !empty($value['url'])){ echo $value['url']; }
					else{ echo 'http://www.actionudaipur.com/static/img/no_img.jpg';}?>">

					<?php echo 'Posté par :<strong>'.$value['username']. '</strong>'; ?>
					<?php echo 'le :'.$value['date_add']; ?>
					<hr>
					<?php echo $value['content']; ?>
					<br><br><br>
				</div>
				<br>
			<?php endforeach; ?>
		</div>
	</section>
<?php else: ?>

<div class="alert alert-danger">
	<p>
		Connectez vous pour voir les commentaire
	</p>
</div>
<?php endif; ?>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script src="<?= $this->assetUrl('js/10_lists.js') ?>"></script>
<?php $this->stop('js') ?>
