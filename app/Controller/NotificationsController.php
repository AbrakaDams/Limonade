<?php

namespace Controller;

use \Controller\MasterController;
use \Model\NotificationsModel;

class NotificationsController extends MasterController
{
	public function updateNotif()
	{
		$json = 'err';
		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}
	  		$idNotif = (int) $post['idNotif'];


	  		$data = [
	  			"is_read"	=> "read",
	  		];

			$NotificationsModel = new NotificationsModel();

			if($NotificationsModel->update($data, $idNotif)){
				$json = ['update' => 'ok'];
			}
			else{
				$json = ['update' => 'ko'];
			}
		}
		$this->showJson($json);
	}
}