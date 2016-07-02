<?php $this->layout('layout', ['title' => 'Résultat de votre recherche']) ?>

<?php $this->start('main_content') ?>


<div class="container">
	<div class="row">
	<?php if(empty($search)): ?>
		<h1 class="search-title">Aucun résultat trouvé... </h1>
		<p>
			Mais voilà un petit verre de limonade pour vous. <a href="<?= $this->url('default_home') ?>"> Retourner à l'accueil </a>
		</p>
		<img src="http://data.whicdn.com/images/195731996/large.gif" alt="verre de limonade" />

		<?php else: ?>
		<h1 class="search-title">Résultat de votre recherche : </h1>
		<?php foreach ($search as $value) :?>
			<div class="col-xs-12 col-sm-4">
				<div class="multiple-event" style="background-image:url('<?php if(!empty($value['event_avatar'])) {echo $value['event_avatar'];}else{echo 'http://www.salvagente.co.za/wp-content/uploads/2016/01/sparkling-bourbon-lemonade-ftr.jpg';} ?>');">

					<span class="multiple-event-category">
						<?php switch ($value['category']) {
							case 'repas' :
								echo 'répas';
								break;
							case 'vacances' :
								echo 'vacances';
								break;
							case 'soiree' :
								echo 'soirée';
								break;
							case 'journee' :
								echo 'journée';
								break;
						}
						?>
					</span>

					<a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>" class="multiple-event-content">

						<p class="multiple-event-role">
							<?php switch($value['role']) {
								case 'private':
									echo '<i class="fa fa-lock" aria-hidden="true"></i> ' . $value['role'];
									break;
								case 'public';
									echo '<i class="fa fa-unlock" aria-hidden="true"></i> ' . $value['role'];
									break;
							} ?>
						</p>

						<p class="multiple-event-date"><i class="fa fa-calendar-o" aria-hidden="true"></i> <span> du  <?php echo date('d/m/Y', strtotime($value['date_start'])) . ' à ' . date('H:m', strtotime($value['date_start'])) .
						'<br> au ' . date('d/m/Y', strtotime($value['date_end'])) . ' à ' . date('H:m', strtotime($value['date_end'])); ?></span></p>

						<p class="multiple-event-address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $value['address']; ?></p>

						<p class="multiple-event-desc"><?php echo $value['description']; ?></p>
					</a>
				</div>

				<h3 class="multiple-event-title"><a href="<?= $this->url('event_showEvent', ['id' => $value['id']]);?>"><?php echo $value['title']; ?></a></h3>

			</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif; ?>

<?php $this->stop('main_content') ?>
