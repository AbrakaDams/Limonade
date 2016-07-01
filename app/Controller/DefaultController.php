<?php

namespace Controller;

use \Controller\MasterController;
use \Model\EventModel as EventModel;
use \Model\ContactModel as Contact;

class DefaultController extends MasterController
{

	/**
	 * Page d'accueil par défaut Si non-connecté  Sinon page accueil connecté
	 */
	public function home()
	{
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
			// Connecté
			$event = new EventModel();
			$role = 'public';
			$eventPublic = $event->getEventPublic($role);

			$showEvent = [
				'thisEventPublic' => $eventPublic,
				
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
