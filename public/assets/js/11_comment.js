var thisEventId = parseInt($('#event-info').data('eventId'));
var thisCommentId = parseInt($('#comment-info').data('commentId'));
//si comment id_user = users id
// Lorsque je soumets le formulaire
$('#form-comment').on('submit', function(e) {
    e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
    var formData = $(this).serialize(); // L'objet jQuery du formulaire
    var comment = $(this).parent().parent().find('#comment').val();


    // Je vérifie une première fois pour ne pas lancer la requête HTTP
    // si je sais que mon PHP renverra une erreur
    if(comment == '') {
        alert('Le champ commentaire dois êtres remplis');
    } else {
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: '../ajax/add-comment', // Le nom du fichier indiqué dans le formulaire
            type: 'POST',  // La méthode indiquée dans le formulaire (get ou post)
            dataType: 'json', // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            data: formData + '&id=' + thisEventId, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function(html) { // Je récupère la réponse du fichier PHP
                // console.log(html);
                if(html.answer == 'success'){
                    showComment();
                    $('#form-comment').each(function(){
                        $(this)[0].reset();
                    });
                } // J'affiche cette réponse
            },
            error: function(e){
                console.log(e);
            }
        });
    }
});
$(function() {
    showComment();
});
function showComment(){
    $.ajax({
        url: '../ajax/join-comment', // Le nom du fichier indiqué dans le formulaire
        type: 'POST',  // La méthode indiquée dans le formulaire (get ou post)
        dataType: 'json', // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        data: 'id=' + thisEventId, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        success: function(html) { // Je récupère la réponse du fichier PHP
                    $('#comments').text('');
                    // console.log(html);
                $.each(html.allComments, function(key, value) {
                    // console.log(value.id_user == html.idUser);
                    if(value.id_user == html.idUser){
                        console.log(html);
                        $('#comments').append('<div class="event-comment" data-id-comment="'+value.id+'"><div class="comment-user"><img class="comment-avatar" src="'+ value.avatar + '"><span class="comment-user-name">'+ value.username +'</span></div><div class="comment-content"><span class="comment-msg">' + value.content + '<a href="#" class="comment-delete" data-delete-comment="' + value.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span><span class="comment-date">' + value.date_add + '</span></div></div>');
                    }else{
                        $('#comments').append('<div class="event-comment" data-id-comment="'+value.id+'"><div class="comment-user"><img class="comment-avatar" src="'+ value.avatar + '"><span class="comment-user-name">'+ value.username +'</span></div><div class="comment-content"><span class="comment-msg">' + value.content + '</span><span class="comment-date">' + value.date_add + '</span></div></div>');
                    }

                });
             // J'affiche cette réponse
        },
    });
}

$('body').on('click', '.comment-delete', function(e){
    e.preventDefault();
    var idComment = $(this).attr('data-delete-comment');
    $.ajax({
        type: 'POST',
        url: '../ajax/delete-comment',
        dataType: 'json',
        data : 'idComment=' + idComment,
        success: function(data){
            // console.log(data);
            if(data.suppression == 'ok'){
                showComment();
            }
        },

    });
});
