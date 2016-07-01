<?php

namespace Controller;

use \Controller\MasterController;
use \Model\EventModel as EventModel;
use \W\Security\AuthentificationModel;

class SearchController extends MasterController
{
	/**
	 * Méthode pour searchResult
	 */

	public function searchResult()
	{
		$authModel = new AuthentificationModel();
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
				if(!empty($_GET) && isset($_GET['search'])){

					$keyword = trim(strip_tags($_GET['search']));
					$eventModel = new EventModel();

					$data =[
						'title' 	=> $keyword,
						'category'	=> $keyword,
					];


					$param = ['search' => $eventModel->search($data)];
				}

				$this->showWithNotif('event/search_result', $param);
			}
		}
	}
}
