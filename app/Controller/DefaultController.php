<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;
use \Model\ContactModel as Contact;

class DefaultController extends Controller
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
			$eventData = $event->findAll($orderBy = 'date_start', $orderDir = 'DESC', $limit = 3);

			$showEvent = ['thisEvent' => $eventData,
			];
			$this->show('default/home_logged', $showEvent);
		}
	}

	/**
	 * Page information de l'équipe
	 */
	public function team()
	{
		$this->show('default/team');
	}	
}
