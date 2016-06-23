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
				<form class="hidden" id="add-list-form" method="POST">
					<label>Titre de ce liste</label>
					<input type="text" name="newList" id="add-list-input" maxlength="150" placeholder="Nom de votre nouveau list">
					<input type="submit" value="Go">
				</form>
			</div>

		<?php endif; ?>
	</section>

	<!-- <script id="lists-template" type="text/x-handlebars-template">
        {{#each lists}}
        <div class="list">
            <div class="list-title">{{title}}</div>
        </div>
        {{/each}}
    </script> -->
<?php $this->stop('main_content') ?>
