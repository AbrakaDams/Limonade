
// html to insert a new card
var newCard = '<div class="add-new-card"><button class="add-card-btn" type="button">Ajouter une tache</button><form class="add-card-form hidden" method="post"><label>Titre de cette tache</label><input type="text" name="card_title" maxlength="150" placeholder="Nom de votre nouvelle card"><br><label for="">Description</label><textarea name="card_desc" rows="8" cols="40"></textarea><br><label for="">Quantite</label><input type="number" name="card_quantity"><br><label for="">Prix</label><input type="number" name="card_price"><br><label for="">Responsable</label><select name="card_person"><option value="0">Choisir</option></select><br><input type="submit" value="Go"><input type="reset" value="reset"></form></div>';

/***************************
ADD LIST FORM/ ADD CARD FORM
**************************/
// hide + button and show hidden form
$(function() {
    $('#add-list-btn').click(function(){
        $('#add-list-btn').addClass('hidden');
        $('#add-list-form').removeClass('hidden');
    });

    $('body').on('click', '.add-card-btn', function(e){
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
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

// hide our add card form if we click anywhere else and if our form is empty
$(document).mouseup(function (e) {
    // if we click anywhere else but not our form
    var cardDiv = $('.add-new-card');

    if (!cardDiv.is(e.target) && cardDiv.has(e.target).length === 0) { // if the target of the click isn't the container ... nor a descendant of the container
        // check every field of the visible form
        // increase counter if one of the is not empty
        // $('.add-card-form:visible').each(function (){
        //     if ($.trim(this.value) != '') {
        //         countEmptyFields++;
        //     }
        // });

        // if all the fields are empty
        if($('.add-card-form:visible').length == 0) {
            $('.add-card-btn').removeClass('hidden');
            $('.add-card-form').addClass('hidden');
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
// /console.log(lastDate);

/***************************
    ADD LIST FORM AJAX
**************************/

$('#add-list-form').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: '../ajax/add-list',
        data: formData+'&eventId='+thisEvent,
        dataType: 'json',
        success: function(output) {
            //console.log(output);
            if(output.answer == 'success') {
                $('#add-list-form').each(function(){
                    $(this)[0].reset();
                });
                // refresh lists right away, prevent to wait 7 seconds
                getContent(lastDate);
                $('#add-list-btn').removeClass('hidden');
                $('#add-list-form').addClass('hidden');
            }
        },
        error: function(e){
            console.log(e);
        }
    });
});

$('body').on('submit', '.add-card-form', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    // get list's id where we want to append our card
    var listId = $(this).parent().siblings().attr('data-id-list');

    console.log(listId);
    $.ajax({
        type: 'POST',
        url: '../ajax/add-card',
        data: formData + '&eventId=' + thisEvent + '&listId=' + listId,
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
                console.log('.add-card-btn:hidden');
                // $(this).removeClass('hidden');
                // $().addClass('hidden');
            }
        }
    });
});


// initialize getContent function on page load
$(function() {
    getContent(lastDate);
});

function getContent(currentDate) {

    $.ajax({
        type: 'POST',
        url: '../ajax/get-list',
        cache: false,
        data: {'myDate': lastDate, 'eventId' : thisEvent},
        dataType: 'json',
        success: function(response){

            console.log(response);
            //reassigning lastDate
            lastDate = response.newDate;
            if(response.newLists.length != 0){
                $.each(response.newLists, function(key, value) {
                    $('#event-lists').append('<div class="event-list"><div class="list" data-id-list="'+value.id+'"><h2 class="list-title">'+ value.title + '</h2></div><div class="cards"></div>' + newCard + '</div>')
                });
            }
            if(response.newCards.length != 0){
                $.each(response.newCards, function(key, value) {

                    var dataToFind = '[data-id-list="'+value.id_list+'"]';
                    var divToFind = 'div[data-id-list="'+value.id_list+'"]';

                    if($(dataToFind).length == 1) {
                        $(divToFind).next().append('<div class="card" data-id-card="'+value.id+'"><h3 class="card-title">'+ value.title+'</h2><p class="card-desc">'+value.description+'</p><span class="card-quantity">Combien : '+value.quantity+'</span><span class="card-price">Prix : '+value.price+'</span></div>');
                    }
                });
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
