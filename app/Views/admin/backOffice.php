<?php $this->layout('layoutAdmin', ['title' => 'Back Office']) ?>

<?php $this->start('main_content') ?>


<div class="listActions">
	<ul>
		<li>
			<a href="<?= $this->url('admin_checkEvent'); ?>">Modifier un évènement</a>
		</li>
		<li>
			<a href="<?= $this->url('admin_checkUser'); ?>">Modifier un utilisateur</a>
		</li>
		<li></li>
	</ul>
</div>



<?php $this->stop('main_content') ?>