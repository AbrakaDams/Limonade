<?php $this->layout('layout', ['title' => 'Affichage recherche']) ?>

<?php $this->start('main_content') ?>
<?php   echo '<div class="event-title">';
		echo '<br>';				
		echo '<h2>' .$search['title'] . '</h2>';
		echo '<br><br>';
		echo '<div class="event-desc">';
		echo '<h2>' .$search['desc'] . '</h2>';
		echo '<br><br>';	
		echo '<div class="event-address">';
		echo '<h2>' .$search['adress'] . '</h2>';
		echo '<br><br>';	
	
?>

<?php $this->stop('main_content') ?> 
