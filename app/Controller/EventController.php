<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\EventModel as EventModel;

class EventController extends Controller
{


	/**
	 * Page d'accueil par défaut
	 */
	public function showEvent($id)
	{
		//make a query to the database to get this event data
		$event = new EventModel();
		$eventData = $event->find($id);

		$list = new ListController();
		$lists = $list->showLists($id);


		// send received data to the event.php
		$showEvent = ['thisEvent' => $eventData,
					  'lists'	  => $lists,
					 ];
		$this->show('event/event', $showEvent);
	}

}
