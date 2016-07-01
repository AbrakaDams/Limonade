
<form class="navbar-form navbar-left" role="search" method="GET" action="<?= $this->url('event_searchResult'); ?>">
	<div class="form-group">
		<input type="text" name="search" class="form-control" placeholder="Entrez le titre d'un évènement">
	</div>
	<button type="submit" class="btn btn-default">Rechercher</button>
</form>
