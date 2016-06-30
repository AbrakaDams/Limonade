$(document).ready(function(){
	$("#notificationLink").click(function(){
		$("#notificationContainer").fadeToggle(300);
		$("#notification_count").fadeOut("slow");
		return false;
	});

	//Document Click hiding the popup 
	$(document).click(function(){
		$("#notificationContainer").hide();
	});

	//Popup on click
	$("a.notification-link").click(function(e){
		e.preventDefault();
		var idNotif = $(this).attr('data-id-notif');
		lien = $(this).attr('href');

		$.ajax({
			type: 'post',
			url: '../ajax/update-notif',
			dataType: 'json',
			data : {'idNotif': idNotif},
			success: function(data){
				console.log(data);
				if(data.update == 'ok'){
					//var link = $(this).attr(href);
					document.location.href=lien;
					/*$('.list-participants').load('../invite/<?= $idEvent; ?> .list-participants');
					$('#invite-message').text("");
					$('#delete-message').text("");
					$('#delete-message').text("Cette personne ne fait plus partie de cet évènement.");*/
				}
			},
			error: function(e){

			}
		});
	});
});
