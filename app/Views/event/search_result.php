<?php $this->layout('layout', ['title' => 'Résultat de votre recherche']) ?>

<?php $this->start('main_content') ?>
	<?php var_dump($search); ?>
 <div class="event-title">
 	<?php foreach ($search as $result) :?>
	<br>			
	<h2> <?php echo $result['title'] ?> </h2>
	<br><br>
	<div class="event-desc">
	<h2> <?php echo $result['description'] ?> </h2>
	<br><br>
	<!-- <div class="event-address">
	<h2> <?php echo $result['adress'] ?> </h2>
	<br><br>
	<div class="event-date">';
	<h2> <?php echo $result['date-start'] ?> </h2>
	<br><br>	 -->
<?php endforeach ?>
<?php $this->stop('main_content') ?>  
