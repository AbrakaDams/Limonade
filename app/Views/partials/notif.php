<a href="#notification" id="notificationLink">
	<?php if($w_unread_notif['haveUnreadNotif']) : ?>
		<i class="glyphicon glyphicon-bell bell-active" style="color: orange;"></i>
	<?php else : ?>
		<i class="glyphicon glyphicon-bell"></i>
	<?php endif ; ?>
</a>
<div id="notificationContainer">
	<div id="notificationTitle">Notifications</div>
	<div id="notificationsBody" class="notifications">
		<?php foreach ($w_notifications as $notification):?>
			<span class="idnotif"></span>
					<a class="notification-link <?= $notification['is_read']?>" href="<?= $this->url('event_showEvent', ['id' => $notification['id_event']]);?>" data-id-notif="<?= $notification['id'];?>">
						<?= $notification['content'].'<br>Le '.$notification['date_create']; ?>
					</a>
					<hr class="sep-notification">
		<?php endforeach; ?>
	</div>
	<div id="notificationFooter"><a href="#">See All</a></div>
</div>