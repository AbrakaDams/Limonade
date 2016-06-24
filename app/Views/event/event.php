<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

	<aside class="">
		<h3>Fil actiliter</h3>
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
			<div id="add-new-list">
				<button type="button" id="add-list-btn">+</button>
				<form class="hidden" id="add-list-form" action="<?=$this->url('list_addList');?>" method="POST">
					<label>Titre de ce liste</label>
					<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouvelle liste">
					<input type="submit" value="Go">
				</form>
			</div>


		<?php endif; ?>
	</section>

	<h1>Response from server:</h1>
        <div id="response"></div>

<?php  if(isset($w_user) && !empty($w_user)):?>
	<section>
		<h3>Commentaire</h3>
		<div class="">
			<?php foreach ($showComments as $value): ?>
				<?php echo $value['id_user']; ?></li>
				<?php echo $value['content']; ?></li>
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
