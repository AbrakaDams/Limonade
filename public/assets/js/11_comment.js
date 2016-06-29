var thisEventId = parseInt($('#event-info').text());
// Lorsque je soumets le formulaire
$('#form-comment').on('submit', function(e) {
    e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire

    var formData = $(this).serialize(); // L'objet jQuery du formulaire

    // Je vérifie une première fois pour ne pas lancer la requête HTTP
    // si je sais que mon PHP renverra une erreur
    if(comment == '') {
        alert('Les champs doivent êtres remplis');
    } else {
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: '../ajax/add-comment', // Le nom du fichier indiqué dans le formulaire
            type: 'POST',  // La méthode indiquée dans le formulaire (get ou post)
            dataType: 'json', // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            data: formData + '&id=' + thisEventId, // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function(html) { // Je récupère la réponse du fichier PHP
                console.log(html);
                if(html.answer == 'success'){
                    showComment();
                    $('#form-comment').each(function(){
                        $(this)[0].reset();
                    });
                } // J'affiche cette réponse
            },
            error : function(e){
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
            console.log(html);
            if(html.allComments.length > 0 ){
                $('#comments').text('');
                $.each(html.allComments, function(key, value) {
                    $('#comments').append('<div class="event-comment" data-id-comment="'+value.id+'">'+ value.username +'  <img class="logo" style="height:2em; width: 2em; border-radius:2em;" src="'+ value.avatar + '">  ' + value.date_add + '<br>' + value.content + ' <a href="#"  class="delete">Supprimer</a>' + '<hr>' + '</div>')
                });
            } // J'affiche cette réponse
        },
        error : function(e){
            console.log(e);
        }
    });
}

$('body').on('click', '.delete', function(e){
    e.preventDefault();
    console.log('hello');
    $.ajax({
        type: 'post',
        url: '../ajax/delete-comment',
        dataType: 'json',
        data : {'thisEventId': thisEventId,},
        success: function(data){
            console.log(data);
        },
        error: function(data){
            console.log(data);
        }
    });
});
