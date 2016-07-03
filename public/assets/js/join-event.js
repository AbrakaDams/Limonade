var thisEventId = parseInt($('#event-info').data('eventId'));
$('.join-event').on('click', function(e){
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: '../ajax/join-event', // Le nom du fichier indiqué dans le formulaire
        dataType: 'json', // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
        data: formData + '&id=' + thisEventId,
        success: function(html){
            console.log('ok');
        },
    })
 });
