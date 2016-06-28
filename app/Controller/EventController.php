<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Controller\NewsFeedController as NewsFeedController;
use \Model\NewsFeedModel as NewsModel;
use \Model\EventModel as EventModel;
use \Model\CommentsModel as CommentsModel;
use \W\Model\UsersModel as UsersModel;

class EventController extends Controller
{
	/**
	 * Afficher la page d'accueil pour utilisateur connecté
	 * @param  Récupere $id de lutilisateur
	 */
	public function showEvent($id)
	{
		/*
		* Liste des participants (5 derniers)
		*/
		$allparticipants = array();
		$participants = array();
		$idUser = array();

		// On récupère les users participant à l'évènement
		$event = new EventModel();
		$EventUsers = $event->getEventUsers($id);
		// $EventUsers retourne toutes les infos de la table event_users
		$UsersModel = new UsersModel();
		// On veut récupèrer 5 participants
		// $idUser récupère l'id de tous les participants à l'évènement
		foreach ($EventUsers as $infos) {
			$idUser[] = $infos['id_user'];
		}

		// Participants récupère les information de la table user des 5 premiers participants
		for ($i=0; $i < 5; $i++) {
			if(!empty($idUser[$i])){
			$participants[] = $UsersModel->find($idUser[$i]);
			}
		}

		foreach ($idUser as $id) {
			$allparticipants[] = $UsersModel->find($id);
		}

		//make a query to the database to get this event data
		$eventData = $event->find($id);

		$news = new NewsModel();
		$showNews = $news->joinNewsFeed($id);

		$comment = new CommentController();
		$showComment = $comment->showComments($id);

		$insertComment = new CommentController();
		$inComment = $insertComment->insertComment($id);

		$showAllComments = new CommentsModel();
		$allComments = $showAllComments->joinComment($id);


		// send received data to the event.php
		$showEvent = [
			'thisEvent'			=> $eventData,
			'newsFeed'			=> $showNews,
			'comments' 			=> $showComment,
			'newsFeed'			=> $showNews,
			'showComments' 		=> $allComments,
			'participants'		=> $participants,
			'allparticipants'	=> $allparticipants,
		 ];
		$this->show('event/event', $showEvent);
	}


	/**
	 * Création d'évènement
	 */
	public function createEvent()
	{
		$post = array();
		$errors = array();
		$success = false;
		$date_debut = '';
		$date_fin = '';
		$newId = NULL;

		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}

	  		if(strtotime($post['date_begin']) > strtotime($post['date_end'])){  // On compare la date de début et la date de fin de l event
	  			$errors[] = 'La date de début ne peut être supérieure à la date de fin';
	  		}
			// Etendue de l event Privée ou Publique
		  	if(empty($post['role'])){
		    	$errors[] = 'Vous devez cocher un bouton !';
		  	}
			// Catégorie de l event
		  	if(empty($post['category'])){
		    	$errors[] = 'Vous devez cocher un bouton !';
			}
			// Titre
			if(strlen($post['title']) < 3 || strlen($post['title']) > 20){
			    $errors[] = 'L\'intitulé de votre événement doit contenir entre 3 et 20 caractères';
			}
			// Description
			if(strlen($post['description']) < 5 || strlen($post['description']) > 200){
			    $errors[] = 'La description doit contenir minimum 5 caractères !';
			}
			if(empty($post['address'])){
			  	$errors[] = 'Veuillez indiquer une adresse';
			}
			// On concatène la date et l'heure de début pour avoir un format valable
			$date_debut = $post['date_begin'].' '.$post['time_begin'].':00';
			if($this->validateDate($date_debut) == false){
				$errors[] = 'La date de début n\'est pas au bon format';
			}
			// On concatène la date et l'heure de fin pour avoir un format valable
			$date_fin = $post['date_end'].' '.$post['time_end'].':00';
			if($this->validateDate($date_fin) == false){
				$errors[] = 'La date de fin n\'est pas au bon format';
			}

			if(count($errors) === 0){
	  			// Il n'y a pas d'erreurs on fait l'insertion SQL
	  			$eventModel = new EventModel();


	  			$data = [
	  				'category' 		=> $post['category'],
	  				'role'     		=> $post['role'],
	  				'title'     	=> $post['title'],
	  				'description' => $post['description'],
	  				'address' 		=> $post['address'],
	  				'date_start' 	=> $date_debut,
	  				'date_end' 		=> $date_fin,
	  			];

	  			$newEvent = $eventModel->insert($data);
	  			if(!empty($newEvent)){
	  				$success = true;

	  			}
	  			var_dump($newEvent);
			}
		}
		$params = [
			'errors' 	=> $errors,
			'success' 	=> $success,
			'newEvent'	=> $newEvent,
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
	 * @param string $date Une date au format DD/MM/YYYY HH:MM:SS
	 * @return bool true si la date est au bon format, false sinon
	 */
	public function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = \DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	/**
	 * Permet de trouver les utilisateurs
	 */
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
