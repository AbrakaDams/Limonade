<?php

namespace Controller;

use \Controller\MasterController;
use \Model\EventModel as EventModel;
use \Model\EventUsersModel;
use \Model\ContactModel as Contact;
use \W\Security\AuthentificationModel;

class DefaultController extends MasterController
{

	/**
	 * Page d'accueil par défaut Si non-connecté  Sinon page accueil connecté
	 */
	public function home()
	{
		$authModel = new AuthentificationModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			// non connecté
			$event = new EventModel();
			$role = 'public';

			$eventPublic = $event->getEventPublic($role);
			$showEventPublic = [
			'thisEvent' => $eventPublic,
			];

			$this->show('default/home', $showEventPublic);
		}else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
				$EventUsersModel = new EventUsersModel();
				$userEvents = $EventUsersModel->find2UserEvents($loggedUser['id']);
				// Connecté
				$event = new EventModel();
				$role = 'public';
				$eventPublic = $event->getEventPublic($role);

				$showEvent = [
					'thisEventPublic' 	=> $eventPublic,
					'myEvents'			=> $userEvents,

				];
				$this->showWithNotif('default/home_logged', $showEvent);
			}
		}
	}

	/**
	 * Page information de l'équipe
	 */
	public function team()
	{
		$this->showWithNotif('default/team');
	}

	/**
	 * Page FAQ
	 */
	public function faq()
	{
		$this->showWithNotif('default/FAQ');
	}


}
