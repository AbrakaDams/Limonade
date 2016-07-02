$(document).ready(function(){
	$("a.notification-link").click(function(e){
		e.preventDefault();
		var idNotif = $(this).attr('data-id-notif');
		lien = $(this).attr('href');

		var pageCourante = window.location.pathname;
		

		if(pageCourante == '/limonade/public/' 
		|| pageCourante == '/limonade/public/updateUser' 
		|| pageCourante == '/limonade/public/create')
		{
			url = "	ajax/update-notif";
		}else
		{
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
