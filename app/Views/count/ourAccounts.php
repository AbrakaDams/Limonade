<?php $this->layout('layout', ['title' => ' Calculer nos dépenses ']) ?>

<?php $this->start('main_content') ?>

<div> La solution pour faire les comptes entre amis
après les vacances, un weekend entre amis, un dîner... </div>
<form  id="account" action="" method="POST">
<h1>Vos comptes</h1>
<hr>
 	<div class="row">
	    <div class="col-xs-6 .col-md-4">
	    	<label for="personn">Entrez le nom de la personne  </label><br>
			<input name="personn" id="personn" type="text" placeholder="ferdie..">

			<label for="purchase">Entrez le nom de l'achat  </label><br>
			<input name="purchase" id="purchase" type="text" placeholder="essence">

			<label for="quantity">Entrez le nombre d'article  </label><br>
			<input name="quantity" id="quantity" type="text" placeholder="1">

			<label for="price">Entrez le montant payé  </label><br>
			<input name="price" id="price" type="text" placeholder="172 euros">
		</div>	
	</div>

	<?php if(isset($sousTotal) && !empty($sousTotal)): ?>
		<ul>
			<?php foreach ($sousTotal as $value): ?>
				<li><?php echo $value['sousTotal']; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<div class="row">
	    <div class="col-xs-6 .col-md-4">
	    	<label for="personn">Entrez le nom de la personne  </label><br>
			<input name="personn" id="personn" type="text" placeholder="ferdie..">

			<label for="purchase">Entrez le nom de l'achat  </label><br>
			<input name="purchase" id="purchase" type="text" placeholder="essence">

			<label for="quantity">Entrez le nombre d'article  </label><br>
			<input name="quantity" id="quantity" type="text" placeholder="1">

			<label for="price">Entrez le montant payé  </label><br>
			<input name="price" id="price" type="text" placeholder="172 euros">
		</div>	
	</div>

	<?php if(isset($sousTotal) && !empty($sousTotal)): ?>
		<ul>
			<?php foreach ($sousTotal as $value): ?>
				<li><?php echo $value['sousTotal']; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

   <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
</form>

	<?php if(isset($total) && !empty($total)): ?>
		<ul>
			<?php foreach ($total as $value): ?>
				<li><?php echo $value['total']; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

<?php $this->stop('main_content') ?>
