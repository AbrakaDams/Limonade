<?php $this->layout('layout', ['title' => 'My event']) ?>

<?php $this->start('main_content') ?>
	
<div id="room_fileds">
	<h2>Inviter des amis à votre évènement</h2>
    <!-- <input type="button" class="btn btn-warning" id="more_fields" onclick="add_fields();" value="+ 1 ami"> -->

    <div class="content" id="remote"> 
        <span>
        	Ajouter un ami : <input type="text" class="typeahead"> <button class="btn btn-success">Ajouter</button>
        </span>
    </div>
    <div>
    	<h2>Liste des amis participants :</h2>
    	<?php foreach ($allParticipants as $user):?>
    		<p>
    			<?= $user['firstname'].' '.$user['lastname'].' ('.$user['username'].')' ?>
    			<a class="delete" href="<?= $this->url('event_deleteParticipant',  ['idEvent' => $idEvent, 'idUser' => $user['id']]); ?>">
    				Supprimer
    			</a>
    		</p>
    	<?php endforeach; ?>
    </div>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js'); ?>
<script type="text/javascript">
	/*function add_fields() {
		document.getElementById('wrapper').innerHTML += '<br><span>Ajouter un ami : <input type="text" class="typeahead">  <button class="btn btn-success">Ajouter</button>\r\n';
	}*/

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

	$('#remote .typeahead').typeahead(null, {
		name: 'countries',
		source:  new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			prefetch: '../ajax/list-users?v='+Math.random()
		}),
	});

</script>
<?php $this->stop('js'); ?>