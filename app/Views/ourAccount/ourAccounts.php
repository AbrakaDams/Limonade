<?php $this->layout('layout', ['title' => ' Calculer nos dépenses ']) ?>

<?php $this->start('main_content') ?>

<div> La solution pour faire les comptes entre amis
après les vacances, un weekend entre amis, un dîner... </div>
<table>
<form name="counts" action="#" method="POST">
	<tr>
		<td><label for="personn">Entrez le nom de la personne  </label><br>
		<input name="personn" id="personn" type="text" placeholder="ferdie.."></td>

		<td><label for="purchase">Entrez le nom de l'achat  </label><br>
		<input name="purchase" id="purchase" type="text" placeholder="essence"></td>

		<td><label for="quantity">Entrez le nombre d'article  </label><br>
		<input name="quantity" id="quantity" type="text" placeholder="1"></td>

		<td><label for="price">Entrez le montant payé  </label><br>
		<input name="price" id="price" type="text" placeholder="172 euros"></td>
	</tr>
	<tr>
		<td>
		<br><hr>
		<button type="submit" value="Calculer" class="btn btn-default" onclick="calculer();"> Calculer </button></td>
		<td>Total TTC</td>
	</tr>
</form>
</table>
<div id="add-new-personn">
	<button type="button" id="add-personn-btn">+ ajouter un compte</button>
	<form class="hidden" id="add-an-account" action="<?=$this->url('list_addList');?>" method="POST">
	<h1>Ajouter des dépenses</h1>
		<table>
			<form name="accounts" action="#" method="POST">
				<tr>
					<td><label for="personn">Entrez le nom de la personne  </label><br>
					<input name="personn" id="personn" type="text" placeholder="ferdie.."></td>

					<td><label for="purchase">Entrez le nom de l'achat  </label><br>
					<input name="purchase" id="purchase" type="text" placeholder="essence"></td>

					<td><label for="quantity">Entrez le nombre d'article  </label><br>
					<input name="quantity" id="quantity" type="text" placeholder="1"></td>

					<td><label for="price">Entrez le montant payé  </label><br>
					<input name="price" id="price" type="text" placeholder="172 euros"></td>
				</tr>
				<tr>
					<td>
					<br><hr>
					<button type="submit" value="Calculer" class="btn btn-default" onclick="calculer();"> Calculer </button></td>
					<td>Total TTC</td>
				</tr>
		</table>
	</form>
</div>


<?php $this->stop('main_content') ?>
