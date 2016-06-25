<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut Si non-connecter  Sinon page accueil connecter
	 */
	public function home()
	{
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			// non connecté
			$this->show('default/home');
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
	 * Page Contact de l'équipe
	 */
	public function team()
	{
		$this->show('default/team');
	}

	/**
	 * Page Contact
	 */

	public function team()
	{
		$this->show('default/team');
	}


}
