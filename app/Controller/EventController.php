<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Controller\NewsFeedController as NewsFeed;
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

		$addList = $list->addList($id);

		$news = new NewsFeed();
		$showNews = $news->newsFeed($id);

		// $comment = new CommentController();
		// $showComment = $comment->showComments($id);

		$comment = new CommentController();
		$showComment = $comment->insertComment($id);


		// send received data to the event.php
		$showEvent = ['thisEvent' => $eventData,
					  'lists'	  => $lists,
					  'addList'	  => $addList,
						'newsFeed' => $showNews,
						'comments' => $showComment,
					 ];
		$this->show('event/event', $showEvent);
	}


	/**
	 * Création d'un événement
	 */
	public function createEvent()
	{
		$this->show('event/create_Event');
	}

}
