<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>
	
<div id="room_fileds">
	<a href="<?= $this->url('event_showEvent', ['id' => $idEvent]);?>">Retour à votre évènement</a>

	<h2>Inviter des amis à votre évènement</h2>

    <form method="post" class="content" id="remote"> 
        	Ajouter un ami : <input type="text" id="username" class="typeahead"> 
        	<button type="submit" class="btn btn-success">Ajouter</button>
    </form>
    <br>
    <div id="invite-message"></div>
    
    <div class="list-participants">
    	<h2>Liste des amis participants :</h2>
    	<?php foreach ($allParticipants as $user):?>
    		<p class="item-participant">
    			<span class="idUser" data-id-user="<?= $user['id'] ?>"></span>
    			<span class="idEvent" data-id-event="<?= $idEvent ?>"></span>
    			<?= $user['firstname'].' '.$user['lastname'].' ('.$user['username'].')' ?>
    			<a class="delete">Supprimer</a>
    		</p>
    	<?php endforeach; ?>
    </div>
    <div id="delete-message"></div>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js'); ?>
	<script src="<?= $this->assetUrl('js/typeahead.bundle.min.js') ?>"></script>
	<script>
		/***************************
		AUTOCOMPLESSION
		**************************/
		var substringMatcher = function(strs) {
		  return function findMatches(q, cb) {
		    var matches, substringRegex;

		    // an array that will be populated with substring matches
		    matches = [];

		    // regex used to determine if a string contains the substring `q`
		    substrRegex = new RegExp(q, 'i');

		    // iterate through the pool of strings and for any string that
		    // contains the substring `q`, add it to the `matches` array
		    $.each(strs, function(i, str) {
		      if (substrRegex.test(str)) {
		        matches.push(str);
		      }
		    });

		    cb(matches);
		  };
		};

		$('form#remote input.typeahead').typeahead(null, {
			name: 'countries',
			source:  new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: '../ajax/list-users?v='+Math.random()
			}),
		});

		/***************************
		ADD PARTICIPANT
		**************************/
		$('form#remote button').on('click', function(e){
			e.preventDefault();

			$.ajax({
				type: 'post',
				url: '../ajax/add-participant',
				dataType: 'json',
				data: {'username': $('#username').val(), 'idEvent': <?=$idEvent;?>},
				success: function(data){

					if(data.resultat == 'ok'){
						$('.list-participants').load('../invite/<?= $idEvent; ?> .list-participants');
						$('#invite-message').text("");
						$('#delete-message').text("");
						$('#invite-message').text("Vous avez bien invité votre ami.");
						$('#remote').each(function(){
		                    $(this)[0].reset();
		                });
					}
					if(data.resultat == 'exist'){
						$('#invite-message').text("");
						$('#delete-message').text("");
						$('#invite-message').text("Vous avez déjà invité cette personne.");
					}
					if(data.resultat == 'ko'){
						$('#invite-message').text("");
						$('#delete-message').text("");
						$('#invite-message').text("Erreur lors de l'invitation.");
					}
					if(data.resultat == 'empty'){
						$('#invite-message').text("");
						$('#delete-message').text("");
						$('#invite-message').text("Veuillez entrer le pseudo du participant.");
					}
				},
				error: function(e){
					console.log(e);
				}
				
			});
		});
		/***************************
		DELET PARTICIPANT
		**************************/
		$('body').on('click', '.delete', function(e){
			e.preventDefault();
			var idEvent = $(this).parent().find(".idEvent").data("idEvent");
			var idUser = $(this).parent().find( ".idUser" ).data("idUser");
			$.ajax({
				type: 'post',
				url: '../ajax/delete-participant',
				dataType: 'json',
				data : {'idEvent': idEvent, 'idUser': idUser},
				success: function(data){

					if(data.suppression == 'ok'){
						$('.list-participants').load('../invite/<?= $idEvent; ?> .list-participants');
						$('#invite-message').text("");
						$('#delete-message').text("");
						$('#delete-message').text("Cette personne ne fait plus partie de cet évènement.");
					}
				},
			});
		});
	</script>
<?php $this->stop('js'); ?>