<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;

class EventController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function showEvent($id)
	{
		$event = new EventModel();
		$eventData = $event->find($id);

		$showEvent = ['thisEvent' => $eventData];
		$this->show('event/event', $showEvent);
	}

}
