<?php

namespace Controller;

use \Controller\MasterController;
use \Controller\ListController;
use \Controller\NewsFeedController;
use \Model\NewsfeedModel as NewsModel;
use \Model\EventModel as EventModel;
use \Model\CommentsModel as CommentsModel;
use \Model\EventUsersModel as EventUsersModel;
use \Model\NotificationsModel;
use \W\Model\UsersModel as UsersModel;


class EventController extends MasterController
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

			$news = new NewsFeedController();
			$newsFeed = $news->newsFeed($id);


			// send received data to the event.php
			$showEvent = [
				'thisEvent'			=> $eventData,
				'showNewsFeed'		=> $newsFeed,
				'participants'		=> $participants,
				'allparticipants'	=> $allparticipants,
			 ];

			$this->showWithNotif('event/event', $showEvent);
		}


	public function getAllParticipants() {
		if(!empty($_POST)) {

			$idEvent = 0;

			if(isset($_POST['idEvent']) && !empty($_POST['idEvent'])) {
				$idEvent = intval($_POST['idEvent']);
			}

			$allUsers = new EventUsersModel();
			$eventUsers = $allUsers->findAllUsers($idEvent);

			$this->showJson(['users' => $eventUsers]);
		}
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
	  		/*$post['date_start'] => 'dd/mm/YYY H:i:s';
	  		$post['date_end']   => 'dd/mm/YYY H:i:s';
	  		*/


	  		/*if(strtotime($post['date_date'] => 'dd/mm/YYY H:i:s') > strtotime($post['date_end'])){  // On compare la date de début et la date de fin de l event
	  			$errors[] = 'La date de début ne peut être supérieure à la date de fin';
	  		}
	  		*/
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
			// d 2 caractères m 2 caractères y 4 caractères h 2 caract m 2 caract
			if(!preg_match('#^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}$#', $post['date_start'])){
    			$errors[] = 'La date n\'est pas au bon format';
			}

			if(!preg_match('#^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}$#', $post['date_end'])){
    			$errors[] = 'La date n\'est pas au bon format';
			}
			/* On concatène la date et l'heure de début pour avoir un format valable
			$date_debut = $post['date_begin'].' '.$post['time_begin'].':00';
			if($this->validateDate($date_debut) == false){
				$errors[] = 'La date de début n\'est pas au bon format';
			}
			// On concatène la date et l'heure de fin pour avoir un format valable
			$date_fin = $post['date_end'].' '.$post['time_end'].':00';
			if($this->validateDate($date_fin) == false){
				$errors[] = 'La date de fin n\'est pas au bon format';
			}
			*/

			if(count($errors) === 0){
	  			// Il n'y a pas d'erreurs on fait l'insertion SQL
	  			$eventModel = new EventModel();
	  			$EventUsersModel = new EventUsersModel();

	  			$data = [
	  				'category' 		=> $post['category'],
	  				'role'     		=> $post['role'],
	  				'title'     	=> $post['title'],
	  				'description'   => $post['description'],
	  				'address' 		=> $post['address'],
	  				'date_start'	=> $post['date_start'],
	  				'date_end'	    => $post['date_start'],
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
	  				if($EventUsersModel->insert($dataEvent)){
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
		$this->showWithNotif('event/create', $params);
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

			$this->showWithNotif('event/invite', $params);
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
		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}
	  		if(!empty($post['username'])){
	  			// On récupère les infos envoyées
		  		$idEvent = $post['idEvent'];
		  		$username = $post['username'];
		  		$eventInfo = '';
		  		// On instancie les class
				$UserModel = new UsersModel();
				$EventUsersModel = new EventUsersModel();

				// On vérifie si l'utilisateur est déjà dans l'évent
				$userInfo = $UserModel->getUserByUsernameOrEmail($username);
				$idUser = $userInfo['id'];
				$exist = $EventUsersModel->findUserInEvent($idEvent, $idUser);

				// Si il y est déjà
				if(!empty($exist)){
					$json = ['resultat' => 'exist'];
				}
				// S'il n'y est pas on l'insère
				else{


					$dataEventUser = [
						'id_event'	=> $idEvent,
						'id_user'	=> $idUser,
						'role'		=> 'event_user',
					];
					$EventUsersModel = new EventUsersModel();

					// Si l'insertion se fait
					if($EventUsersModel->insert($dataEventUser)){
						// On récupère le titre de l'évènement
						$eventModel = new EventModel();
						$eventInfo = $eventModel->find($idEvent);
						$phraseType = 'Vous avez été invité à l\'évènement : ';
						$phraseType .= $eventInfo['title'];

						// On prépare la notification
						$date_create = date('Y-m-d h:i:s');
						$dataNotification = [
							'id_user' 		=> $idUser,
							'id_Event' 		=> $idEvent,
							'content'		=> $phraseType,
							'date_create'	=> $date_create,
						];
						$NotificationsModel = new NotificationsModel();
						// On créé la notification
						$NotificationsModel->insert($dataNotification);

						$json = ['resultat' => 'ok'];
					}
					else {
						$json = ['resultat' => 'ko'];
					}
				}
			}
			else{
				$json = ['resultat' => 'empty']; // Ici c'est si on a entré un champ vide
			}
		}
		$this->showJson($json);
	}

	public function deleteParticipant()
	{
		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}
	  		$idEvent = $post['idEvent'];
	  		$idUser = $post['idUser'];

			$EventUsersModel = new EventUsersModel();

			if($EventUsersModel->deleteParticipant($idEvent, $idUser)){
				$json = ['suppression' => 'ok'];
			}
			else{
				$json = ['suppression' => 'ko'];
			}
		}
		$this->showJson($json);
	}
}
