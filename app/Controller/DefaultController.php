<?php

namespace Controller;

use \Controller\MasterController;
use \Model\EventModel as EventModel;
use \Model\EventUsersModel;
use \Model\ContactModel as Contact;

class DefaultController extends MasterController
{

	/**
	 * Page d'accueil par défaut Si non-connecté  Sinon page accueil connecté
	 */
	public function home()
	{
		$loggedUser = $this->getUser();
		var_dump($loggedUser);
		if(!isset($loggedUser) && $loggedUser['etat'] != 'banned'){
			// non connecté
			$event = new EventModel();
			$role = 'public';

			$eventPublic = $event->getEventPublic($role);
			$showEventPublic = [
			'thisEvent' => $eventPublic,
			];

			$this->show('default/home', $showEventPublic);
		}else{

			$EventUsersModel = new EventUsersModel();
			$userEvents = $EventUsersModel->findAllUserEvents($loggedUser['id']);
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
