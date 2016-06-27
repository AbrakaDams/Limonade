// var newList = '<form><label>Titre de ce liste</label><input type="text" name="newList" placeholder="Nom de votre nouveau list"></form>';

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

var thisEvent = parseInt($('#event-info').text());
//console.log(thisEvent);
var lastDate = 0;


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
            if(output.answer == 'success') {
                $('#add-list-form').each(function(){
                    this.reset();
                });
                // refresh lists right away, prevent to wait 7 seconds
                getContent(lastDate);
            }
        }
    });
});

$('.add-card-form').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    // console.log(formData);
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
            if(output.answer == 'success') {
                $('.add-card-form').each(function(){
                    $(this)[0].reset();
                });
                // refresh lists right away, prevent to wait 7 seconds
                getContent(lastDate);
            }
        }
    });
});


// initialize jQuery
$(function() {
    getContent(0);
});

function getContent(currentDate) {

    console.log(currentDate);

    $.ajax({
        type: 'POST',
        url: '../ajax/get-list',
        cache: false,
        data: {'myDate': lastDate, 'eventId' : thisEvent},
        dataType: 'json',
        success: function(response){

            console.log(response);
            lastDate = response.newDate;
            if(response.newList.length != 0){
                $.each(response.newList, function(key, value) {
                    $('#response').append('<div class="event-list-'+value.id+'">'+ value.title +'</div>')
                });
            }
            if(response.newCard.length =! 0) {
                // console.log(response.newCard);
            }
        },
        error: function(e) {
            console.log(e);
        },
        complete: function(){
            setTimeout(function(){getContent(lastDate)}, 7000);
        }
    });
}
