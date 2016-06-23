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

		$comment = new CommentController();
		$showComment = $comment->showComments($id);

		$insertComment = new CommentController();
		$inComment = $insertComment->insertComment($id);

		$showAllComments = new CommentController();
		$allComments = $showAllComments->showAllComments($id);


		// send received data to the event.php
		$showEvent = ['thisEvent' => $eventData,
					  'lists'	  => $lists,
					  'addList'	  => $addList,
						'newsFeed' => $showNews,
						'comments' => $showComment,
						'showComments' => $allComments,
					 ];
		$this->show('event/event', $showEvent);
	}


	/**
	 * Création d'un événement
	 */

	public function createEvent()
	{
		$post = array();
		$errors = array();

	if(!empty($_POST)){
  		foreach ($_POST as $key => $value) {
    		$post[$key] = trim(strip_tags($value));
  		}
	// Etendue de l event Privée ou Publique
  	if(!empty($post['role'])){
    	$errors[] = 'Vous devez cocher un bouton !';
  	}
	// Catégorie de l event
  	if(!empty($post['category'])){
    	$errors[] = 'Vous devez cocher un bouton !';
	  	}
	// Titre
	  if(!strlen($post['title']) < 3 || strlen($post['title']) > 20){
	    $errors[] = 'L\'intitulé de votre événement doit contenir entre 3 et 20 caractères';
	  }
	// Description
	  if(strlen($post['description']) < 5 || strlen($post['description']) > 200){
	    $errors[] = 'La description doit contenir minimum 5 caractères !';
	  }

	// Infos event
	  if(!empty($_POST)){
	    // Infos street
	    if(strlen($post['street']) < 4 || strlen($post['street']) > 100){
	      $errors[] = 'Cette partie doit contenir votre numéro de rue et son nom';
	    }
	    // Infos zipcode
	    if(is_numeric($post['zipcode'])){
	      $errors[] = 'Votre adresse postale doit contenir 5';
	      }
	    // Infos city
	    if(empty($post['city'])){
	      $errors[] = 'Votre ville doit être sous forme de caractères';
	    }
	    // Infos country
	    if(strlen($post['country']) < 3 || strlen($post['country']) > 30){
	      $errors[] = 'Votre pays doit être supérieur à 3 caractères';
	    }
	  }
	}
		$this->show('event/create_Event');
	}

}
