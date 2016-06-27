<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Controller\NewsFeedController as NewsFeed;
use \Model\EventModel as EventModel;
use \Model\CommentsModel as CommentsModel;
use \W\Model\UsersModel as UsersModel;

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
		// $lists = $list->getList($id);
		$addList = $list->addList($id);

		$news = new NewsFeed();
		$showNews = $news->newsFeed($id);

		$comment = new CommentController();
		$showComment = $comment->showComments($id);

		$insertComment = new CommentController();
		$inComment = $insertComment->insertComment($id);

		$showAllComments = new CommentsModel();
		$allComments = $showAllComments->joinComment($id);


		// send received data to the event.php
		$showEvent = [
			'thisEvent' => $eventData,
			//   'lists'	  => $lists,
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
		$success = null;


		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}

	  		if(strtotime($post['date_begin']) <= strtotime($post['date_end'])){  // On compare la date de début et la date de fin de l event
	  			$errors[] = 'La date de début ne peut être supérieure à la date de fin';
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
			if(!empty($post['address'])){
			  	$errors[] = 'Veuillez indiquer une adresse';
			}

			if(!$this->valideFormatDate($post['date_begin'])){
				$error[] = 'La date de début n\'est pas au bon format';
			}

			if(!$this->valideFormatDate($post['date_end'])){
				$error[] = 'La date de fin n\'est pas au bon format';
			}

			if(count($errors) === 0){
	  			// Il n'y a pas d'erreurs on fait l'insertion SQL
	  			$eventModel = new EventModel();


	  			$data = [
	  				'category' => $post['category'],
	  				'role'     => $post['role'],
	  				'title'     => $post['title'],
	  				'description' => $post['description'],
	  				'address' => $post['address'],
	  				'date_start' => $post['date_begin'],
	  				'date_end' => $post['date_end'],
	  			];
	  			$eventModel->insert($data);

			}
		}

		$params = [
			'errors' 	=> $errors,
			'success' 	=> $success,
		];

		$this->show('event/create', $params);
	}

	/**
	* Invitation à un évènement
	*/
	public function invite($id)
	{
		/*// On instancie les variables
		$username = array();

		$UsersModel = new UsersModel();
		// On récupère les infos de tous les utilisateurs
		$users = $UsersModel->findAll();

		// On en sélectionne que les "username"
		foreach ($users as $user) {
			$username[] = $user['username'];
		}
		var_dump($username);
		$params = ['username' => $username];*/
		$this->show('event/invite');
	}

	/**
	 * Valide une date au format français
	 * @param string $date Une date au format DD/MM/YYYY
	 * @return bool true si la date est au bon format, false sinon
	 */
	public function valideFormatDate($date){
		if(preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $date)){  // Vérif du format
			return true;
		} else {
			return false;
		}
	}
	/**
	* ^ Start of line
	* \A Start of string
    * \z End of string
	*
	*
	* $ End of line
	**/

	public function listUsers(){
		$username = array();

		// On récupère les infos de tous les utilisateurs
		$UsersModel = new UsersModel();
		$users = $UsersModel->findAll();

		// On en sélectionne que les "username"
		foreach ($users as $user) {
			$username[] = $user['username'];
		}

		/*$fp = fopen('usersSearch.json', 'W+');
		fwrite($fp, json_encode($username));
		fclose($fp);*/

		/*$params = ['username' => $username];
		$this->show('event/invite', $params);*/

		json_encode($username);
	}

		/**
	* Gestion des budget
	*/
	public function ourAccounts()
	{
		
		$this->show('event/ourAccounts');
	}
}
