<?php $this->layout('layoutAdmin', ['title' => 'Back Office']) ?>

<?php $this->start('main_content') ?>
<h2>Bienvenue sur l'interface d'administration du site</h2>
<br>

<h4><strong>Liste d'actions possibles</strong></h4>

<div class="listActions">
	<strong>
		<ul>
			<li>
				<a href="<?= $this->url('admin_events'); ?>">Liste des &nbsp; <i class="fa fa-calendar-o" aria-hidden="true"></i> évènements ?</a>
			</li>
			<li>
				<a href="<?= $this->url('admin_users'); ?>">Liste des  &nbsp; <i class="fa fa-users" aria-hidden="true"></i> utilisateurs ?</a>
			</li>
			<li>
				<a href="<?= $this->url('admin_comments'); ?>">Liste des  &nbsp; <i class="fa fa-commenting-o" aria-hidden="true"></i> commentaires ?</a>
			</li>
			<li>
				<a href="<?= $this->url('admin_messageConctact'); ?>">Liste des   &nbsp;  <i class="fa fa-comments-o" aria-hidden="true"></i> messages(contact) ?</a>
			</li>
			<br><br>
			<li>
				<a href="<?= $this->url('default_home'); ?>">Retour sur le site</a>
			</li>
		</ul>
	</strong>
</div>




<?php $this->stop('main_content') ?>
