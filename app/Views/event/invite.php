<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>
	
<div id="room_fileds">
	<h2>Inviter des amis à votre évènement
    	<input type="button" class="btn btn-warning" id="more_fields" onclick="add_fields();" value="+ 1 ami">
    </h2>
    <div class="content" id="wrapper"> 
        <span>
        	Ajouter un ami : <input type="text"> <button class="btn btn-success">Ajouter</button>
        </span>
    </div>
</div>

	<script type="text/javascript">
		function add_fields() {
    		document.getElementById('wrapper').innerHTML += '<br><br><span>Ajouter un ami : <input type="text">  <button class="btn btn-success">Ajouter</button>\r\n';
		}
	</script>
<?php $this->stop('main_content') ?>