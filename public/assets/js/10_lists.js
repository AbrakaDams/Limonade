// get event id
var thisEvent = parseInt($('#event-info').data('eventId'));

$('#event-price').text('0');
/***************************
ADD LIST FORM/ ADD CARD FORM
**************************/
// hide + button and show hidden form
$(function() {
    $('#add-list-btn').click(function(){
        $('#add-list-btn').addClass('hidden');
        $('#add-list-form').removeClass('hidden');
        $('#add-list-input').focus();
    });

    $('body').on('click', '.add-card-btn', function(e){
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
    });

    $('body').on('click', '.close-modify-card', function(e){
        var hideModif = $(this).parent();
        $(hideModif).addClass('hidden');
    });

    $('body').on('click', '.delete-list-link', function(e){
        e.preventDefault();
        var showDelContainer = $(this).next('.delete-list-container');
        // console.log(showDelContainer);
        $(showDelContainer).removeClass('hidden');
    });

    $('body').on('click', '.delete-list-no', function(e){
        e.preventDefault();
        var showDelContainer = $(this).closest('.delete-list-container');
        $(showDelContainer).addClass('hidden');
    });

    $('#event-lists').bind('change paste keyup', '.modify-card-form input, textarea, select', function() {
        // console.log("lalalalal");

        var inputValue = $(this).val();
        // console.log(inputValue);
        $(this).attr('value', inputValue);
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
var newCardStart = '<div class="add-new-card"><button class="add-card-btn" type="button">Ajouter une tache</button><form class="add-card-form hidden" method="post"><label>Titre de cette tache*</label><br><input type="text" name="card_title" maxlength="50" placeholder="Nom de votre nouvelle card" required><br><label for="">Description*</label><br><textarea name="card_desc" placeholder="Description de cette tache" required></textarea><br><div class="add-new-nums"><label for="">Quantite*</label><br><input type="number" name="card_quantity" placeholder="0" required></div><div class="add-new-nums"><label for="">Prix unitaire*</label><br><input type="number" name="card_price" placeholder="0" required></div><br><label for="">Responsable</label><br><select name="card_person"><option value="0">Choisir</option>';
// we suppose to append more options to selecs with js
// the rest of the form
var newCardEnd = '</select><br><input type="submit" value="Go"><input type="reset" value="reset"></form></div>';

// newCard = newCardStart + createCardOptions(data.users) + newCardEnd
var newCard;

var modifyCardMiddle;
// var modifyCard;

// get all event participants
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '../ajax/get-all-participants',
        dataType: 'json',
        data: 'idEvent=' + thisEvent,
        success: function(data) {
            newCard = newCardStart + createCardOptions(data.users) + newCardEnd;
            modifyCardMiddle = createCardOptions(data.users);
            getContent(lastDate);
        },
    });
});

function createCardOptions(users) {
    // console.log(users);
    var allOptions = '';
        $.each(users, function(key, value) {
            if(value.id == value.id_user) {
                allOptions += '<option value="' + value.id +'" selected>'+ value.firstname + ' '+ value.lastname +'</option>';
            }
            else {
                allOptions += '<option value="' + value.id +'">'+ value.firstname + ' '+ value.lastname +'</option>';
            }
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
            // console.log(output);
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
        // error: function(e){
        //     console.log(e);
        // }
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
                getPrice(thisEvent);
            }
        },
        // error: function(e) {
        //     console.log(e);
        // }
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
                    if(response.eventRole == 'private' || (response.eventRole == 'public' && response.userRole == "event_admin")) {
                        $('<div class="event-list"><div class="list" data-id-list="'+value.id+'"><form class="modify-list-form" method="post"><input type="text" class="list-title" name="list_title" value="'+ value.list_title + '"></form><a href class="delete-list-link"><i class="fa fa-times" aria-hidden="true"></i></a><span class="delete-list-container hidden"><span class="delete-list-phrase">Vous etes sur? En supprimant cette liste vous aller supprimer toutes ces taches <a href="#" class="delete-list" data-delete-list="'+value.id+'">Oui</a><a class="delete-list-no" href="">Non</a></span></span></div><div class="cards"></div>' + newCard + '</div>').insertBefore('#add-new-list');
                    }
                    else {
                        $('#event-lists').append('<div class="event-list"><div class="list" data-id-list="'+value.id+'"><h3 class="list-title-no-form">'+ value.list_title + '</h3></div><div class="cards"></div></div>');
                    }

                });
            }
            if(response.newCards.length != 0){

                $.each(response.newCards, function(key, value) {

                    var dataToFind = '[data-id-list="'+value.id_list+'"]';
                    var divToFind = 'div[data-id-list="'+value.id_list+'"]';

                    if($(dataToFind).length == 1) {

                        if(response.eventRole == 'private' || (response.eventRole == 'public' && response.userRole == "event_admin")) {
                            $(divToFind).next().append('<div class="card" data-id-card="'+value.id+'"><h5 class="card-title">'+ value.card_title+'<span class="card-quantity"> &#x2715; '+value.quantity+'</span><span class="card-links"><a href="#" class="modify-card" data-modify-card="'+value.id+'"><i class="fa fa-pencil" aria-hidden="true"></i><span class="modify-card-container hidden"><span class="modify-card-title">Modifier tache</span><span class="close-modify-card">+</span><form class="modify-card-form" method="post"><label>Titre de cette tache*</label><input type="text" name="card_title" maxlength="150" value="'+value.card_title+'"><br><label for="">Description*</label><textarea name="card_desc">'+value.description+'</textarea><div class="add-new-nums"><label for="">Quantite*</label><input type="number" name="card_quantity" value="'+value.quantity+'"></div><div class="add-new-nums"><label for="">Prix*</label><input type="number" name="card_price" value="'+value.price+'"></div><label for="">Responsable</label><br><select name="card_person"><option value="0">Choisir</option>'+ modifyCardMiddle +'</select><br><input type="submit" value="Go"></form></span></a><a href="#" class="delete-card" data-delete-card="'+value.id+'"><i class="fa fa-times" aria-hidden="true"></i></a></span></h5><span class="card-price">Prix : '+value.price+' &#8364;</span><p class="card-desc">'+value.description+'</p><span class="card-responsible">'+(value.username != null ? '<i class="fa fa-check-circle" aria-hidden="true"></i> ' + value.username : ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Personne')+' s\'en occupe</span></div>');
                            }
                        else {
                            $(divToFind).next().append('<div class="card" data-id-card="'+value.id+'"><h5 class="card-title">'+ value.card_title+'<span class="card-quantity"> &#x2715; '+value.quantity+'</span></h5><span class="card-price">Prix : '+value.price+' &#8364;</span><p class="card-desc">'+value.description+'</p><span class="card-responsible">'+(value.username != null ? '<i class="fa fa-check-circle" aria-hidden="true"></i> ' + value.username : ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Personne')+' s\'en occupe</span></div>');
                        }
                        getPrice(thisEvent);

                    }
                });
            }
        },
        // error: function(e) {
        //     console.log(e);
        // },
        complete: function(){
            getNewsFeed();
            setTimeout(function(){getContent(lastDate)}, 7000);
        }
    });
}

$('#event-lists').on('click', '.delete-list', function(e) {
    e.preventDefault();

    var idList = $(this).attr('data-delete-list');
    var list = $(this).closest('div.event-list');
    // console.log(this);
    $.ajax({
        type: 'POST',
        url: '../ajax/delete-list',
        dataType: 'json',
        data: 'idList=' + idList + '&idEvent=' + thisEvent,
        success: function(data) {
            // console.log(data);
            if(data.deleteList == 'done') {
                $(list).fadeOut();
                //console.log(data.deleteList);
            }
            getPrice(thisEvent);
        },
        error: function(e) {
            // console.log(e);
        }
    });
});

$('#event-lists').on('click', '.delete-card', function(e) {
    e.preventDefault();

    var idCard = $(this).attr('data-delete-card');
    var card = $(this).closest('.card');
    $.ajax({
        type: 'POST',
        url: '../ajax/delete-card',
        dataType: 'json',
        data: 'idCard=' + idCard + '&idEvent=' + thisEvent,
        success: function(data) {
            if(data.deleteCard == 'done') {
                $(card).fadeOut();
            }
            getPrice(thisEvent);
        }
    })
});


$(document).ready(function() {
    modifyList();
});
function modifyList() {
    $('#event-lists').on('focusout submit', '.modify-list-form', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var thisList = $(this).closest('.list').attr('data-id-list');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../ajax/modify-list',
            data: formData + '&idEvent=' + thisEvent + '&idList=' + thisList,
            success: function(result) {
                if(result.answer == 'success') {
                    refreshList(thisList);
                }
            },
            // error: function(e) {
            //     console.log(e);
            // }
        });
    });
}

function refreshList(id) {
    // console.log('je suis');
    $.ajax({
        type: 'POST',
        url: '../ajax/refresh-list',
        data: 'idList=' + id,
        dataType: 'json',
        success: function(result) {
            // console.log('almost');
            // console.log(result);
            var listToRefresh = $('div.list[data-id-list="' + id + '"] .list-title').val(result.card.list_title);
        },
        // error: function(e) {
        //     console.log(e);
        // }
    });
}


var modifCard;
var modifForm;
var idCard;

$(document).ready(function() {
    $('#event-lists').on('click', '.modify-card', function(e) {
        e.preventDefault();

        idCard = $(this).attr('data-modify-card');

        var modifCard = $(this).find('.modify-card-container');

        $(modifCard).removeClass('hidden');
        //$(modifCard).css('display', 'block');

        // var modifBtnPosition = $(this).position();
        // console.log(modifBtnPosition);
        // $(modifCard).css({
        //   top: modifBtnPosition.top,
        //   left: modifBtnPosition.left + Math.round(modifCard.outerWidth() * 0.75)
        // });

        modifForm = $(this).find('.modify-card-form');

        //$(modifForm).submit(function() { console.log('Hehe');});
    });


    $('#event-lists').delegate('form.modify-card-form input[type=submit]', "click", function(e) {
        // console.log('modif function is called');
        modifyCard(modifForm, e);
    });

    function modifyCard(form, e) {

        // $(form).on('submit', function(e) {
            // console.log('inside function');
            e.preventDefault();
            //console.log('3:'+modifForm);
            var formData = $(form).serialize();
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: '../ajax/modify-card',
                data: formData + '&eventId=' + thisEvent + '&cardId=' + idCard,
                dataType: 'json',
                success: function(output) {
                    // console.log(output);
                    if(output.answer == 'modified') {
                        $('.modify-card-form').each(function(){
                            $(this)[0].reset();
                        });
                        $(modifCard).addClass('hidden');
                        refreshCard(idCard);
                        getPrice(thisEvent);
                    }
                },
                // error: function(e) {
                //     console.log(e);
                // }
            });
        // });
    }

});


function refreshCard(id) {
    // console.log('modify card ' + modifyCard);
    $.ajax({
        type: 'POST',
        url: '../ajax/refresh-card',
        data: 'idCard=' + id,
        dataType: 'json',
        success: function(result) {
            // console.log('id dans refresh ' + id);
            // console.log(result);
            var cardToRefresh = $('div.card[data-id-card="' + id + '"]').text('');
            // console.log('object to insert' + cardToRefresh);
            // console.log('card_title ' + result.card[0].card_title);
            $(cardToRefresh).text('');
            $(cardToRefresh).append('<h5 class="card-title">'+ result.card[0].card_title+' &#x2715; <span class="card-quantity">'+result.card[0].quantity+' </span><span class="card-links"><a href="#" class="modify-card" data-modify-card="'+result.card[0].id+'"><i class="fa fa-pencil" aria-hidden="true"></i><span class="modify-card-container hidden"><span class="modify-card-title">Modifier tache</span><span class="close-modify-card">+</span><form class="modify-card-form" method="post"><label>Titre de cette tache</label><input type="text" name="card_title" maxlength="150" value="'+result.card[0].card_title+'"><br><label for="">Description</label><textarea name="card_desc">'+result.card[0].description+'</textarea><div class="add-new-nums"><label for="">Quantite</label><input type="number" name="card_quantity" value="'+result.card[0].quantity+'"></div><div class="add-new-nums"><label for="">Prix</label><input type="number" name="card_price" value="'+ result.card[0].price + '"></div><label for="">Responsable</label><br><select name="card_person"><option value="0">Choisir</option>'+ modifyCardMiddle +'</select><br><input type="submit" value="Go"></form></span></a><a href="#" class="delete-card" data-delete-card="'+result.card[0].id+'"><i class="fa fa-times" aria-hidden="true"></i></a></span></h5><span class="card-price">Prix : '+result.card[0].price+'</span><p class="card-desc">'+result.card[0].description+'</p><span class="card-responsible">' + (result.card[0].username != null ? '<i class="fa fa-check-circle" aria-hidden="true"></i> ' +  result.card[0].username : ' <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Personne') + ' s\'en occupe</span>');
        },
        // error: function(e) {
        //     console.log(e);
        // }
    });
}

function getPrice(id) {
    $.ajax({
        type: 'POST',
        url: '../ajax/get-price',
        dataType: 'json',
        data: 'idEvent=' + id,
        success: function(output) {
            // console.log(output);
            if(output.answer == 'success') {
                $('#event-price').text('');
                $('#event-price').text(output.price);
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}


function getNewsFeed() {
    // console.log('newsfeed');
    $.ajax({
        type: 'POST',
        data: 'idEvent=' + thisEvent,
        dataType: 'json',
        url: '../ajax/get-newsfeed',
        success: function(output) {
            console.log(output);
            $('#event-newsfeed').text('');
            if(output.news.length != 0) {
                $.each(output.news, function(key, value) {

                    if(value.list_name.length == 0 && value.card_name.length != 0) {
                        var phraseToAppend =  '';
                        phraseToAppend += '<div class="event-news"><p><strong>'+value.username + ' </strong>';
                            if(value.action == 'add') {
                                phraseToAppend += ' a ajouté ';
                            }else if(value.action == 'modify') {
                                phraseToAppend +=  ' a modifié ';
                            }else if(value.action == 'remove') {
                                phraseToAppend += ' a supprimé ';
                            }
                        phraseToAppend += 'la tâche <strong>' + value.card_name + '</strong> le ' + value.date_news + '</p></div><hr>';
                        $('#event-newsfeed').prepend(phraseToAppend);
                        // console.log(value.date_news);
                    }

                    if(value.list_name.length != 0 && value.card_name.length == 0) {
                        var phraseToAppend =  '';
                        phraseToAppend += '<div class="event-news"><p><strong>'+value.username + ' </strong>';
                            if(value.action == 'add') {
                                phraseToAppend += ' a ajouté ';
                            }else if(value.action == 'modify') {
                                phraseToAppend +=  ' a modifié ';
                            }else if(value.action == 'remove') {
                                phraseToAppend += ' a supprimé ';
                            }
                        phraseToAppend += 'la liste <strong>' + value.list_name + '</strong> le ' + value.date_news + '</p></div><hr>';
                        $('#event-newsfeed').prepend(phraseToAppend);
                    }
                });
            }
            else {
                $('#event-newsfeed').prepend('Pas d\'actualité ...');
            }

        },
        // error: function(e) {
        //     console.log(e);
        // }
    })
}
