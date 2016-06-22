<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>

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
	<?php if(isset($thisEvent['title']) && !empty($thisEvent['title'])): ?>
		<p class="event-date"><?php echo $thisEvent['title']; ?></p>
	<?php else: ?>
		<p class="event-date">Date n'est pas encore precisée</p>
	<?php endif; ?>

	<!-- SHOW EVENT ADDRESS -->
	<?php if(isset($thisEvent['address']) && !empty($thisEvent['address'])): ?>
		<p class="event-address"><?php echo $thisEvent['address']; ?></p>
	<?php else: ?>
		<p class="event-address">Adresse n'est pas encore precisé</p>
	<?php endif; ?>

	<?php var_dump($thisEvent); ?>
<?php $this->stop('main_content') ?>
