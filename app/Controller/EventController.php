<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel;

class EventController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function showEvent($id)
	{
		$this->show('event/event');
	}

}
