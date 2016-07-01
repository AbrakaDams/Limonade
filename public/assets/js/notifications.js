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

		var pageCourante = window.location.pathname;
		console.log(pageCourante);

		if(pageCourante == '/limonade/public/' || pageCourante == '/limonade/public/updateUser' || 'limonade/public/create'){
			url = "	ajax/update-notif";
		}else{
			url = "../ajax/update-notif";
		}

		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
			data : {'idNotif': idNotif},
			success: function(data){
				console.log(data);
				if(data.update == 'ok'){
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
