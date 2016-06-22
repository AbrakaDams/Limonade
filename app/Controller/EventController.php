<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\EventModel as EventModel;

class EventController extends Controller
{


	// public function showLists() {
	//
	// }

	// public function __construct() {
	//
	//     // Create a collection of clients
	//     $this->clients = new \SplObjectStorage;
	//
	//     $this->games = Fixtures::random();
	// }

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
