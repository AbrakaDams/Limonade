<?php $this->layout('layoutAdmin', ['title' => 'Back Office']) ?>

<?php $this->start('main_content') ?>
<h2>Bienvenue sur l'interface d'administration du site</h2>
<br>

<h5>Liste d'actions possibles</h5>

<div class="listActions">
	<ul>
		<li>
			<a href="<?= $this->url('admin_events'); ?>">Liste des évènements ?</a>
		</li>
		<li>
			<a href="<?= $this->url('admin_users'); ?>">Liste des utilisateurs ?</a>
		</li>
		<li>
			<a href="<?= $this->url('admin_comments'); ?>">Liste des commentaires ?</a>
		</li>
		<li>
			<a href="<?= $this->url('admin_messageConctact'); ?>">Liste des messages(contact) ?</a>
		</li>
		<br><br>
		<li>
			<a href="<?= $this->url('default_home'); ?>">Retour sur le site</a>
		</li>
	</ul>
</div>




<?php $this->stop('main_content') ?>
