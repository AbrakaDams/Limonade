var newList = '<form><label>Titre de ce liste</label><input type="text" name="newList" placeholder="Nom de votre nouveau list"></form>';


/***************************
CONNECTION FOR WEBSOCKETS
**************************/
// var conn = new ab.Session('ws://localhost:9000',
//     function() {
//         conn.subscribe('kittensCategory', function(topic, data) {
//             // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
//             console.log('New article published to category "' + topic + '" : ' + data.title);
//         });
//     },
//     function() {
//         console.warn('WebSocket connection closed');
//     },
//     {'skipSubprotocolCheck': true}
// );

// var conn = new WebSocket('ws://localhost:9000');
// conn.onopen = function(e) {
//     console.log("Connection established!");
// };
//
// conn.onmessage = function(e) {
//     console.log(e.data);
// };

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

    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        dataType: 'json',
        error: function(e){
            console.table(e);
        },
        success: function(output) {
            console.log(output);
            if(output == 'success') {
                $('#add-list-form').each(function(){
                    this.reset();
                });
            }
        }
    });

});



/**
 * AJAX long-polling
 *
 * 1. sends a request to the server (without a timestamp parameter)
 * 2. waits for an answer from server.php (which can take forever)
 * 3. if server.php responds (whenever), put data_from_file into #response
 * 4. and call the function again
 *
 * @param timestamp
 */
// function getContent(timestamp)
// {
//     var queryString = {'timestamp' : timestamp};
//
//     $.ajax(
//         {
//             type: 'GET',
//             url: 'get-list',
//             data: queryString,
//             success: function(data){
//                 // put result data into "obj"
//                 console.log(data);
//                 var obj = jQuery.parseJSON(data);
//                 // put the data_from_file into #response
//                 $('#response').html(obj.data_from_file);
//                 // call the function again, this time with the timestamp we just got from server.php
//                 getContent(obj.timestamp);
//             }
//         }
//     );
// }
//
// // initialize jQuery
// $(function() {
//     getContent();
// });
