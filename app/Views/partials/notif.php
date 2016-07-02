<!-- notifications -->
<?php if(isset($w_notifications)): ?>
	<li class="dropdown notifications">
		<a href="#" class="dropdown-toggle show-account-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<?php if(isset($w_unread_notif) && $w_unread_notif['haveUnreadNotif']) : ?>
				<i class="glyphicon glyphicon-bell" style="color: orange;"></i>
			<?php else : ?>
				<i class="glyphicon glyphicon-bell"></i>
			<?php endif ; ?>
		</a>
		<!-- <div id="notificationContainer">
			<div id="notificationsBody" class="notifications"> -->
		<ul class="dropdown-menu notifications-body">				
			<?php foreach ($w_notifications as $notification):?>
				<li>
					<a class="notification-link <?= $notification['is_read']?>" href="<?= $this->url('event_showEvent', ['id' => $notification['id_event']]);?>" data-id-notif="<?= $notification['id'];?>">
						<?= $notification['content'].'<br>Le '.$notification['date_create']; ?>
					</a>
					<hr class="sep-notification">
				</li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endif; ?>