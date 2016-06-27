<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

	<?php echo '<span id="event-info">' .$thisEvent['id'].'</span>'; ?>

	<div>
		<a href="<?= $this->url('event_invite',  ['id' => $thisEvent['id']]); ?>" class="btn btn-default btn-lg active" role="button">Inviter des amis</a>
	</div>

	<div>
		<h3> Liste des participants :</h3>
		
		<?php 
		foreach ($participants as $infos) {
			echo $infos['firstname'].' '.$infos['lastname'].'<br>' ;
		}
		?>
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
		<div id="add-new-list">
			<button type="button" id="add-list-btn">+</button>
			<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
				<label>Titre de ce liste</label>
				<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
				<input type="submit" value="Go">
			</form>
		</div>
	</section>


    <div id="response"></div>

<?php  if(isset($w_user) && !empty($w_user)):?>
	<section>
		<h3>Commentaire</h3>
		<div class="">
			<?php foreach ($showComments as $value): ?>
				<div style="border-radius: 5px; background-color: rgb(163, 161, 208);" class="">
				<img class="logo" style="height:2em; width: 2em; border-radius:2em;" src="
				<?php if(isset($value['avatar']) && !empty($value['avatar'])){
									echo $value['avatar'];
								}elseif(isset($value['url']) && !empty($value['url'])){
									echo $value['url']; } else{ echo 'http://www.actionudaipur.com/static/img/no_img.jpg';}?>">
				<?php echo 'Posté par :<strong>'.$value['username']. '</strong>'; ?>
				<?php echo 'le :'.$value['date_add']; ?>
				<hr>
				<?php echo $value['content']; ?>
				<br>
				<br>
				<br>
				</div>
				<br>
			<?php endforeach; ?>
		</div>

		<form method="post">
			<textarea name="comment" rows="2" cols="50"></textarea>
			<input type="submit" name="submit" value="Commentez">
		</form>
	</section>
<?php else: ?>
<div class="alert alert-danger">
	<p>
		Connectez vous pour voir les commentaire
	</p>
</div>
<?php endif; ?>
<?php $this->stop('main_content') ?>
