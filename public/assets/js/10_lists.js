// get event id
var thisEvent = parseInt($('#event-info').data('eventId'));

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

//hide our add card form if we click anywhere else and if our form is empty
$(document).mouseup(function (e) {
    // if we click anywhere else but not our form
    var cardForm = $('.add-card-form');
    // console.log(cardDiv);

    if (!cardForm.is(e.target) && cardForm.has(e.target).length === 0) { // if the target of the click isn't the container ... nor a descendant of the container
        //if all the fields are empty
        $('.add-card-btn').removeClass('hidden');
        $(cardForm).addClass('hidden');

    }
});


// html to insert a new card
// first part of the form
var newCardStart = '<div class="add-new-card"><button class="add-card-btn" type="button">Ajouter une tache</button><form class="add-card-form hidden" method="post"><label>Titre de cette tache</label><input type="text" name="card_title" maxlength="150" placeholder="Nom de votre nouvelle card"><br><label for="">Description</label><textarea name="card_desc"></textarea><br><label for="">Quantite</label><input type="number" name="card_quantity"><br><label for="">Prix</label><input type="number" name="card_price"><br><label for="">Responsable</label><select name="card_person"><option value="0">Choisir</option>';
// we suppose to append more options to selecs with js
// the rest of the form
var newCardEnd = '</select><br><input type="submit" value="Go"><input type="reset" value="reset"></form></div>';

// newCard = newCardStart + createCardOptions(data.users) + newCardEnd
var newCard;

// get all event participants
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '../ajax/get-all-participants',
        dataType: 'json',
        data: 'idEvent=' + thisEvent,
        success: function(data) {
            newCard = newCardStart + createCardOptions(data.users) + newCardEnd;
            getContent(lastDate);
        },
    });
});

function createCardOptions(users) {
    // console.log(users);
    var allOptions = '';
        $.each(users, function(key, value) {
            allOptions += '<option value="' + value.id +' ">'+ value.firstname + ' '+ value.lastname +'</option>'
        });
    return allOptions;
}

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

    $.ajax({
        type: 'POST',
        url: '../ajax/add-card',
        data: formData + '&eventId=' + thisEvent + '&listId=' + listId,
        dataType: 'json',
        success: function(output) {
            if(output.answer == 'success') {
                $('.add-card-form').each(function(){
                    $(this)[0].reset();
                });
                // refresh lists right away, prevent to wait 7 seconds
                getContent(lastDate);
                $('.add-card-btn').removeClass('hidden');
                $('.add-card-form').addClass('hidden');
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
});


var lastDate = 0;
// initialize getContent function on page load




function getContent(currentDate) {

    $.ajax({
        type: 'POST',
        url: '../ajax/get-list',
        cache: false,
        data: {'myDate': lastDate, 'eventId' : thisEvent},
        dataType: 'json',
        success: function(response){

            // console.log(response);
            //reassigning lastDate
            lastDate = response.newDate;
            if(response.newLists.length != 0){
                $.each(response.newLists, function(key, value) {
                    $('#event-lists').append('<div class="event-list"><div class="list" data-id-list="'+value.id+'"><h4 class="list-title">'+ value.list_title + '</h4><a href="#" data-delete-list="'+value.id+'" class="delete-list"><i class="fa fa-times" aria-hidden="true"></i></a></div><div class="cards"></div>' + newCard + '</div>')
                });
            }
            if(response.newCards.length != 0){

                $.each(response.newCards, function(key, value) {

                    var dataToFind = '[data-id-list="'+value.id_list+'"]';
                    var divToFind = 'div[data-id-list="'+value.id_list+'"]';

                    if($(dataToFind).length == 1) {
                        $(divToFind).next().append('<div class="card" data-id-card="'+value.id+'"><h5 class="card-title">'+ value.card_title+'<span class="card-quantity"> &#x2715; '+value.quantity+'</span><span class="card-links"><a href="#" class="modify-card" data-modify-card="'+value.id+'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="#" class="delete-card" data-delete-card="'+value.id+'"><i class="fa fa-times" aria-hidden="true"></i></a></span></h5><span class="card-price">Prix : '+value.price+' &#8364;</span><p class="card-desc">'+value.description+'</p><span class="card-responsable">'+value.username+' s\'en occupe</span></div>');
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

$('#event-lists').on('click', '.delete-list', function(e) {
    e.preventDefault();

    var idList = $(this).attr('data-delete-list');
    var list = $(this).closest('div.event-list');
    // console.log(list);
    $.ajax({
        type: 'POST',
        url: '../ajax/delete-list',
        dataType: 'json',
        data: 'idList=' + idList + '&idEvent=' + thisEvent,
        success: function(data) {
            if(data.deleteList == 'done') {
                $(list).fadeOut();
                //console.log(data.deleteList);
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
});

$('#event-lists').on('click', '.delete-card', function(e) {
    e.preventDefault();

    var idCard = $(this).attr('data-delete-card');
    var card = $(this).parent();
    $.ajax({
        type: 'POST',
        url: '../ajax/delete-card',
        dataType: 'json',
        data: 'idCard=' + idCard + '&idEvent=' + thisEvent,
        success: function(data) {
            console.log(data);
            if(data.deleteCard == 'done') {
                $(card).fadeOut();
            }
        }
    })
});
