<?php $this->layout('layoutAdmin', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Bonjour</h2>

<div class="listActions">
	<ul>
		<li>
			<a href="<?= $this->url('admin_checkEvent'); ?>">Modifier un évènement</a>
		</li>
		<li>
			<a href="<?= $this->url('admin_checkUser'); ?>">Modifier un utilisateur</a>
		</li>		
	</ul>
</div>




<?php $this->stop('main_content') ?>