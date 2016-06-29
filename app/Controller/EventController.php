<?php

namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Controller\NewsFeedController as NewsFeedController;
use \Model\NewsFeedModel as NewsModel;
use \Model\EventModel as EventModel;
use \Model\CommentsModel as CommentsModel;
use \W\Model\UsersModel as UsersModel;
use \Model\EventUsersModel as EventUsersModel;

class EventController extends Controller
{
	/**
	 * Afficher la page d'accueil pour utilisateur connecté
	 * @param  Récupere $id de lutilisateur
	 */
	public function showEvent($id)
	{ 	/*
			* Liste des participants (5 derniers)
			*/
			$participants = array();
			$allparticipants = array();
			$idUsers = array();

			// On récupère les users participant à l'évènement
			$EventModel = new EventModel();
			$UsersModel = new UsersModel();
			$EventUsersModel = new EventUsersModel();

			$EventParticipants = $EventUsersModel->getEventUsers($id);

			// $EventUsers retourne toutes les infos de la table event_users
			// On veut récupèrer 5 participants
			// $idUser récupère l'id de tous les participants à l'évènement
			foreach ($EventParticipants as $infosParticipant) {
				$idUsers[] = $infosParticipant['id_user'];
			}

			// Participants récupère les information de la table user des 5 premiers participants
			for ($i=0; $i < 5; $i++) {
				if(!empty($idUsers[$i])){
				$participants[] = $UsersModel->find($idUsers[$i]);
				}
			}

			foreach ($idUsers as $idUser) {
				$allparticipants[] = $UsersModel->find($idUser);
			}

			//make a query to the database to get this event data
			$eventData = $EventModel->find($id);


			$news = new NewsModel();
			$showNews = $news->joinNewsFeed($id);

			$insertComment = new CommentController();
			$inComment = $insertComment->insertComment($id);


			// send received data to the event.php
			$showEvent = [
				'thisEvent'			=> $eventData,
				'newsFeed'			=> $showNews,
				'newsFeed'			=> $showNews,
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
		$newEvent = '';
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
	  				$infoUser = $this->getUser();
	  				$id = $infoUser['id'];
	  				$dataEvent = [
	  					'id_event'	=> $newEvent['id'],
	  					'id_user'	=> $id,
	  					'role'		=> 'event_admin',
	  				];
	  				if($eventModel->insertEventUsers($dataEvent)){
	  					$success = true;
	  				}
	  				else{
	  					echo $errors[] = 'erreur lors de la création de l\'évènement';
	  				}
	  			}
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
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			// non connecté
			$this->redirectToRoute('default_home');
		}else{
			$idEvent = $id;
			$allParticipants = array();
			$idUser = array();
			// On récupère les users participant à l'évènement
			$event = new EventModel();
			$EventUsersModel = new EventUsersModel();
			$EventUsers = $EventUsersModel->getEventUsers($id);
			// $EventUsers retourne toutes les infos de la table event_users
			$UsersModel = new UsersModel();
			// On veut récupèrer 5 participants
			// $idUser récupère l'id de tous les participants à l'évènement
			foreach ($EventUsers as $infos) {
				$idUser[] = $infos['id_user'];
			}
			foreach ($idUser as $id) {
				$allParticipants[] = $UsersModel->find($id);
			}
			$params = [
				'allParticipants' 	=> $allParticipants,
				'idEvent'			=> $idEvent
			];

			$this->show('event/invite', $params);
		}
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

		$this->showJson($username);
	}

	/**
	* Gestion des budget
	*/
	public function ourAccounts()
	{

		$this->show('event/ourAccounts');
	}

	public function addParticipant()
	{
  		$json = ['resultat' => 'rien'];

		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}
	  		$idEvent = $post['idEvent'];
	  		$username = $post['username'];

	  		$eventModel = new EventModel();
			$UserModel = new UsersModel();
			$EventUsersModel = new EventUsersModel();

			$userInfo = $UserModel->getUserByUsernameOrEmail($username);
			$idUser = $userInfo['id'];

			$exist = $EventUsersModel->findUserInEvent($idEvent, $idUser);

			if(!empty($exist)){
				$json = ['resultat' => 'exist'];
			}
			else{
				$dataEvent = [
					'id_event'	=> $idEvent,
					'id_user'	=> $idUser,
					'role'		=> 'event_user',
				];
				$EventUsersModel = new EventUsersModel();
				$insert = $EventUsersModel->insert($dataEvent);

				if($insert){
					$json = ['resultat' => 'ok'];
				}
				else {
					$json = ['resultat' => 'ko'];
				}
			}
		}
		$this->showJson($json);
	}

	public function deleteParticipant($idEvent, $idUser)
	{
		$EventUsersModel = new EventUsersModel();

		if($EventUsersModel->deleteParticipant($idEvent, $idUser)){
			echo 'BLABLABLA';
		}

		$this->showJson('event/deleteParticipant');
	}
}
