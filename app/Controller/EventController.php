<?php

namespace Controller;

use \Controller\MasterController;
use \Controller\ListController;
use \Controller\NewsFeedController;
use \Model\NewsfeedModel as NewsModel;
use \Model\EventModel as EventModel;
use \Model\CommentsModel as CommentsModel;
use \Model\ListModel;
use \Model\EventUsersModel as EventUsersModel;
use \Model\NotificationsModel;
use \W\Model\UsersModel as UsersModel;
use \W\Security\AuthentificationModel as AuthModel;
use \PDO;

class EventController extends MasterController
{
	/**
	 * Afficher la page d'accueil pour utilisateur connecté
	 * @param  Récupere $id de lutilisateur
	 */
	public function showEvent($id)
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
        if(!isset($loggedUser)){
            $this->redirectToRoute('user_login');
        }
        else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
				else{
				$EventModel = new EventModel();
				$UsersModel = new UsersModel();
				$EventUsersModel = new EventUsersModel();
				if(!$EventModel->find($id)){
					$this->showNotFound();
				}
				else{
					/*
					* Liste des participants (5 derniers)
					*/
					$participants = array();
					$allparticipants = array();
					$idUsers = array();

					// On récupère les users participant à l'évènement

					$EventParticipants = $EventUsersModel->getEventUsers($id);

					$participants = $EventUsersModel->findAllUsers($id);

					$eventData = $EventModel->find($id);

					$news = new NewsFeedController();
					$newsFeed = $news->newsFeed($id);

					// On récupère les infos du user connecté
					$authModel = new AuthModel();
					$user = $authModel->getLoggedUser();

					$eventRole = $EventUsersModel->findUserInEvent($id,$user['id']);

					// On récupère les évènements auquel l'utilisateur participe
					$userEvents = $EventUsersModel->findAllUserEvents($user['id']);

					// send received data to the event.php
					$showEvent = [
						'thisEvent'			=> $eventData,
						'showNewsFeed'		=> $newsFeed,
						'participants'		=> $participants,
						'userEvents'		=> $userEvents,
						'roleEvent'			=> $eventRole,
					 ];

					$this->showWithNotif('event/event', $showEvent);
				}
			}
		}
	}

	 /**
	 * Calcul le dus d'argent par personne
	 * @param  Récupere $id de l'event
	 */
	public function calcul()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
				if(isset($_POST['idEvent']) && is_numeric($_POST['idEvent'])) {

					$eventUsersModel = new EventUsersModel();
					$user =	$eventUsersModel->findAllUsers($_POST['idEvent']);

					$numberUsers = count($user);

					$card = new ListModel();
					$cardPrice = $card->findCards($_POST['idEvent'], 0);

					$total = 0;

					foreach ($cardPrice as $key => $value) {
						$total += $value['price'] * $value['quantity'];
					}
					$perPerson = ceil($total / $numberUsers);

					$this->showJson(['answer' => 'success', 'price' => $perPerson]);
				}
			}
		}
	}


	public function getAllParticipants() {
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
        if(!isset($loggedUser)){
            $this->redirectToRoute('default_home');
        }
        else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
		}
	}


	/**
	 * Création d'évènements
	 */
	public function createEvent()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('user_login');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
				$post = array();
				$errors = array();
				$success = false;
				$date_debut = '';
				$date_fin = '';
				$newEvent = '';
				$data = '';
				$newId = NULL;
				$successimg = false;
				$adress = ''; //adress est visible pour toute la fonction

				//A l'insertion de l'image dans le formulaire, il est placé dans le fichier assets
				$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/img/event/';
				$dbLink = '/limonade/public/assets/img/event';
				$maxSize = 1000000 * 5; // 5 Mo => taille maximale de mon fichier

				if(!empty($_FILES) && isset($_FILES['avatar'])){

					// Récupère le nom de mon fichier
					$nomFichier = $_FILES['avatar']['name'];
					// Stockage temporaire du fichier
					$tmpFichier = $_FILES['avatar']['tmp_name'];
					// Créer une chaine de caractère contenant le nom du dossier de destination et le nom du fichier final
					$newFichier = $folder.$nomFichier;
					// Permet de vérifier que la taille du fichier est inférieure ou égale à $maxSize
					if($_FILES['avatar']['size'] <= $maxSize){
						/*
						 * move_uploaded_file() retourne un booleen :
						 *	- true si le fichier a bien été déplacé/envoyé
						 *  - false si il y a une erreur
						 */
						if(move_uploaded_file($tmpFichier, $newFichier)){
							$successimg = true;
							$adress = $dbLink.'/'.$nomFichier;
						}
						else {
							$error = 'Erreur lors de l\'envoi du fichier';
						}
					}
				}

				if(!empty($_POST)){
			  		foreach ($_POST as $key => $value) {
			    		$post[$key] = trim(strip_tags($value));
			  		}

			  		/*$post['date_start'] => 'dd/mm/YYY H:i:s';
			  		$post['date_end']   => 'dd/mm/YYY H:i:s';
			  		*/

			  		$data = $post;
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
					if(!isset($_FILES['avatar']) && !filter_var($post['eventAvatar'], FILTER_VALIDATE_URL)){
						$errors[] = 'Vous devez choisir une image de couverture pour continuer';
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

			  			$newdateStart = \DateTime::createFromFormat('d/m/Y H:i', $post['date_start']);
		  				$newdateEnd = \DateTime::createFromFormat('d/m/Y H:i', $post['date_end']);

			  			$data = [
			  				'category' 		=> $post['category'],
			  				'role'     		=> $post['role'],
			  				'title'     	=> $post['title'],
			  				'description'   => $post['description'],
			  				'address' 		=> $post['address'],
							'event_avatar'	=> $post['eventAvatar'],
							'event_cover'	=> $adress,
			  				'date_start'	=> $newdateStart->format('Y-m-d H:m:s'),
		  					'date_end'	    => $newdateEnd->format('Y-m-d H:m:s'),
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
			  					echo $errors[] = 'Il y a une erreur lors de la création de l\'évènement';
			  				}
			  			}
					}
				}
			}
			$params = [
				'errors' 	=> $errors,
				'success' 	=> $success,
				'newEvent'	=> $newEvent,
				'data'		=> $data,
			];
			$this->showWithNotif('event/create', $params);
		}
	}
	public function update($id)
	{
		$loggedUser = $this->getUser();
		$eventUsersModel = new EventUsersModel;
		$eventUserInfo = $eventUsersModel->findUserInEvent($id, $loggedUser['id']);

		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		elseif($eventUserInfo['role'] !== 'event_admin'){
			$this->redirectToRoute('default_home');
		}
		else{

			$post = array();
			$errors = array();
			$success = false;
			$date_start = '';
			$date_end = '';
			$eventData = array();
			$successimg = false;
			$adress = ''; //adress est visible pour toute la fonction

			//A l'insertion de l'image dans le formulaire, il est placé dans le fichier assets
			$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/img/event/';
			$dbLink = '/limonade/public/assets/img/event';
			$maxSize = 1000000 * 5; // 5 Mo => taille maximale de mon fichier

			if(!empty($_FILES) && isset($_FILES['avatar'])){

				// Récupère le nom de mon fichier
				$nomFichier = $_FILES['avatar']['name'];
				// Stockage temporaire du fichier
				$tmpFichier = $_FILES['avatar']['tmp_name'];
				// Créer une chaine de caractère contenant le nom du dossier de destination et le nom du fichier final
				$newFichier = $folder.$nomFichier;
				// Permet de vérifier que la taille du fichier est inférieure ou égale à $maxSize
				if($_FILES['avatar']['size'] <= $maxSize){
					/*
					 * move_uploaded_file() retourne un booleen :
					 *	- true si le fichier a bien été déplacé/envoyé
					 *  - false si il y a une erreur
					 */
					if(move_uploaded_file($tmpFichier, $newFichier)){
						$successimg = true;
						$adress = $dbLink.'/'.$nomFichier;
					}
					else {
						$error = 'Erreur lors de l\'envoi du fichier';
					}
				}
			}

			if(isset($id) && is_numeric($id)){

				$eventModel = new EventModel;
				$eventData = $eventModel->find($id);

			}
			if(!empty($_POST)){
				foreach($_POST as $key => $value){
					$post[$key] = trim(strip_tags($value));
				}
				if(empty($post['role'])){
					$errors[] = 'Vous devez cocher un bouton rôle !';
				}
				if(empty($post['category'])){
					$errors[] = 'Vous devez cocher un bouton catégorie !';
				}
				if(strlen($post['title']) < 3 || strlen($post['title']) > 30){
					$errors[] = 'Le titre de votre évènement doit contenir entre 3 et 30 caractères';
				}
				if(strlen($post['description']) < 5 || strlen($post['description']) > 200){
					$errors[] = 'La description doit contenir minimum 5 caractères';
				}
				if(empty($post['address'])){
					$errors[] = 'Veuillez indiquer une adresse correcte';
				}
				if(!preg_match('#^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}$#', $post['date_start'])){
	    			$errors[] = 'La date n\'est pas au bon format';
				}
				if(!isset($_FILES['avatar']) && !filter_var($post['eventAvatar'], FILTER_VALIDATE_URL)){
					$errors[] = 'Vous devez choisir une image de couverture pour continuer';
				}
				if(!preg_match('#^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}$#', $post['date_end'])){
	    			$errors[] = 'La date n\'est pas au bon format';
				}
				if(count($errors) === 0){

					$eventModel = new EventModel();


					$newdateStart = \DateTime::createFromFormat('d/m/Y H:i', $post['date_start']);
		  			$newdateEnd = \DateTime::createFromFormat('d/m/Y H:i', $post['date_end']);

					$data = [
						'id'            => $id,
						'category' 		=> $post['category'],
		  				'role'     		=> $post['role'],
		  				'title'     	=> $post['title'],
		  				'description'   => $post['description'],
		  				'address' 		=> $post['address'],
						'event_avatar'	=> $post['eventAvatar'],
						'event_cover'	=> $adress,
		  				'date_start'	=> $newdateStart->format('Y-m-d H:m:s'),
	 	  				'date_end'	    => $newdateEnd->format('Y-m-d H:m:s'),
					];

					$newEvent = $eventModel->find($data['id']);

					if($eventModel->update($data,$data['id'])){
						$success = true;
						$eventData = $data;
					}
					else{
						echo $errors[] = 'Il y a eu une erreur dans la modification de votre évènement !';
					}
				}
			}
			$params = [
				'errors'    	=> $errors,
				'success' 		=> $success,
				'eventData' 	=> $eventData,
				'eventUserInfo'	=> $eventUserInfo,
			];
			$this->show('event/update', $params);
		}
	}

	/**
	* Invitation à un évènement
	*/
	public function invite($id)
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			// non connecté
			$this->redirectToRoute('default_home');
		}else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
		}
	}

	public function addParticipant()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
									'id_event' 		=> $idEvent,
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
		}
	}

	public function deleteParticipant()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{
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
	}

	public function searchResult()
	{
		$authModel = new AuthModel();
		$authModel->refreshUser();
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			if($loggedUser['status'] == 'banned'){
				$this->show('default/home_banned');
			}
			else{

				$this->showWithNotif('event/search-result');
			}
		}
	}
}
