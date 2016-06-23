var newList = '<form><label>Titre de ce liste</label><input type="text" name="newList" placeholder="Nom de votre nouveau list"></form>';


/***************************
CONNECTION FOR WEBSOCKETS
**************************/
var conn = new ab.Session('ws://localhost:8080',
    function() {
        conn.subscribe('kittensCategory', function(topic, data) {
            // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
            console.log('New article published to category "' + topic + '" : ' + data.title);
        });
    },
    function() {
        console.warn('WebSocket connection closed');
    },
    {'skipSubprotocolCheck': true}
);

/***************************
    ADD LIST FORM
**************************/

$(function() {
    $('#add-list-btn').click(function(){
        $('#add-list-btn').addClass('hidden');
        $('#add-list-form').removeClass('hidden');
    });

});

// hide our add list input if we click anywhere else and if our input is empty
$(document).mouseup(function (e) {
    // if we click anywhere else but not our form
    var listDiv = $("#add-new-list");

    if (!listDiv.is(e.target) && listDiv.has(e.target).length === 0) { // if the target of the click isn't the container ... nor a descendant of the container
        var listForm = $.trim($('#add-list-input').val());
        if(listForm.length == 0) {
            $('#add-list-btn').removeClass('hidden');
            $('#add-list-form').addClass('hidden');
        }
    }
});


/***************************
    ADD LIST FORM AJAX
**************************/

$('#add-list-form').on('submit', function(e) {
    e.preventDefault();
});

/******************************
   Formulaire create_event
*******************************/

//  Calendrier


