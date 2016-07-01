<?php $this->layout('layoutAdmin', ['title' => 'Back Office']) ?>

<?php $this->start('main_content') ?>
<h2>Bonjour</h2>


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
	</ul>
</div>






<?php $this->stop('main_content') ?>
