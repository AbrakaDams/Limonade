<?php $this->layout('layout', ['title' => 'Résultat de votre recherche']) ?>

<?php $this->start('main_content') ?>


<div class="container">
	<div class="row">	
	<?php if(empty($search)): ?>
		<h1>Aucun résultat trouvé... </h1>
		<p><strong><br>
			<a href="<?= $this->url('default_home') ?>"> Retour Accueil </a></strong>
		</p>	
		<?php else: ?>
		<h1>Résultat de votre recherche : </h1>
		<?php foreach ($search as $result) :?>
			<div class="col-xs-4">
				<div class="index-event" style="background-image:url('<? if(!empty($value['avatar'])) {echo $value['avatar'];}else{echo ''} ?>');">
            	
					<h2><a href="<?= $this->url('event_showEvent', ['id' => $result['id']]);?>">
						<?php echo $result['title'] ?></a>
					</h2>	
					<div class="index-event-content">
						<p><?php echo $result['description'] ?></p>
						<p><?php echo $result['address'] ?></p>
						<p><?php echo $result['date_start'] ?></p>
						<p><?php echo $result['category'] ?></p>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>	
<?php endif; ?>

<?php $this->stop('main_content') ?>
