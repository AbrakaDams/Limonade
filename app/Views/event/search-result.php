<?php $this->layout('layout', ['title' => 'Résultat de votre recherche']) ?>

<?php $this->start('main_content') ?>
 <div class="event-title">
	<br>;				
	<h2> <?php echo $search['title'] ?> </h2>
	<br><br>;
	<div class="event-desc">
	<h2> <?php echo $search['desciprtion'] ?> </h2>
	<br><br>
	<div class="event-address">
	<h2> <?php echo $search['adress'] ?> </h2>
	<br><br>
	<div class="event-date">';
	<h2> <?php echo $search['date-start'] ?> </h2>
	<br><br>	
<?php $this->stop('main_content') ?>  
