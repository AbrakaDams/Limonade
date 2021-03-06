<?php

namespace Controller;

use \Controller\MasterController;
use \Model\NotificationsModel;
use \W\Security\AuthentificationModel as AuthModel;

class NotificationsController extends MasterController
{
	public function updateNotif()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
	}

	public function haveUnreadNotif()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
				$authModel = new AuthModel();
				$user =  $authModel->getLoggedUser();

				$notificationsModel = new NotificationsModel();
				$haveUnreadNotif = $notificationsModel->haveUnreadNotif($user['id']);

				$data = [
					'haveUnreadNotif' => $haveUnreadNotif,
				];

				return $data;

				//$this->showWithNotif('partials/notif', $data);

			}
		}
	}
}
