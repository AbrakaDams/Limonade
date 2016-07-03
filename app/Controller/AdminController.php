<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\NewsfeedModel as NewsFeedModel;
use \Model\AdminModel as AdminModel;
use \Model\EventModel as EventsModel;
use \Model\CommentsModel;
use \Model\ContactModel;
use \W\Model\UsersModel as UsersModel;
use \W\security\AuthentificationModel as AuthModel;


class AdminController extends Controller
{
	/**
	 * Si il n'y a personne de connecter on rediriger vers la page d'accueil
	 * Sinon on regarde si le role = 'admin'
	 * Si user = redirige vers error 403
	 * Si admin = affichage du back_office
	 */
	public function admin()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$this->show('admin/index');}
	}

	/******
	*
	* Function pour modifier un event
	*
	***/
	public function checkEvent($id)
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
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

				$adminModel = new AdminModel;
				$eventData = $adminModel->findEvent($id);

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

					$adminModel = new AdminModel();
					$EventUsersModel = new EventsModel();

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

					$newEvent = $adminModel->findEvent($data['id']);

					if($EventUsersModel->update($data,$data['id'])){
						$success = true;
						$eventData = $data;
					}
					else{
						echo $errors[] = 'Il y a eu une erreur dans la modification de votre évènement !';
					}
				}
			}
			$params = [
				'errors'    => $errors,
				'success' 	=> $success,
				'eventData' => $eventData,
			];
			$this->show('admin/checkEvent', $params);
		}
	}

	/*****
	*
	* Fonction pour modifier un utilisateur
	*
	***/
	public function checkUser($id)
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$authModel = new AuthModel();
			$authModel->refreshUser();
			$this->allowTo('admin');
			$post = array();
			$errors = array();
			$success = false;
			$successimg = false;
			$userData = array();

			$adminModel = new AdminModel();
			$userData = $adminModel->findUser($id);

			$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/image/';
			$dbLink = '/limonade/public/assets/image';
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
				foreach($_POST as $key => $value){
					$post[$key] = trim(strip_tags($value));
				}
				if (strlen($post['username']) < 3 || strlen($post['username']) > 18){
					$errors[] = 'Votre pseudo doit contenir entre 3 et 18 caractères';
				}
				if (strlen($post['firstname']) < 2 || strlen($post['firstname']) > 12){
					$errors[] = 'Votre prénom doit contenir entre 2 et 12 caractères';
				}
				if (strlen($post['lastname']) < 2 || strlen($post['lastname']) > 13){
					$errors[] = 'Votre nom doit contenir entre 2 et 13 caractères';
				}
				if(!isset($_FILES['avatar']) && !filter_var($post['url'], FILTER_VALIDATE_URL)){
					$errors[] = 'Vous devez choisir un avatar pour continuer';
				}

				if(count($errors) === 0){

					$usersModel = new UsersModel();
					$status = $userData['status'];

					$data = [
						'id' 		=> $id,
						'username' 	=> $post['username'],
						'firstname' => $post['firstname'],
						'lastname' 	=> $post['lastname'],
						'role' 		=> 'user',
						'avatar' 	=> $post['url'],
						'status'	=> $status,
					];


					if($usersModel->update($data,$data['id'])){
						$success = true;
						$userData = $data;
					}
					else{
						echo $errors[] = 'Il y a eu un problème lors de la modification de l\'utilisateur';
					}
				}
			}
			$params = [
				'errors' 	=> $errors,
				'success' 	=> $success,
				'userData' 	=> $userData,
			];
			$this->show('admin/checkUser', $params);
		}
	}

	public function checkContact()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$authModel = new AuthModel();
			$authModel->refreshUser();
			$this->allowTo('admin');

			$idMessage = $_GET['id'];

			$checkContact = new ContactModel();
			$findContact = $checkContact->find($idMessage);

			$msgRead = ['check' => 'check'];

			$updContact = $checkContact->update($msgRead,$idMessage);

		}
	}

	public function banUser($id){
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$usersModel = new UsersModel;
			$user = $usersModel->find($id);

			if($user['status'] == 'default'){
				$data = [
					'status' => 'banned',
				];
				$usersUpateModel = new UsersModel();
				$usersUpateModel->update($data, $id);
			}elseif ($user['status'] == 'banned') {
				$data = [
					'status' => 'default',
				];
				$usersUpateModel = new UsersModel();
				$usersUpateModel->update($data, $id);
			}
			$this->redirectToRoute('admin_users');
		}
	}

	/*****
	*
	* Fonction pour modifier un utilisateur
	*
	***/
	public function users()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$usersModel = new UsersModel;
			$users = $usersModel->findAll();

			$params = ['users' => $users];

			$this->show('admin/users', $params);
		}
	}

	public function events()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$eventsModel = new EventsModel;
			$events = $eventsModel->findAll('date_start','ASC');

			$params = ['events' => $events];

			$this->show('admin/events', $params);
		}
	}

	public function comments()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$commentsModel = new CommentsModel;
			$comments = $commentsModel->findAllComments();


			$params = ['comments' => $comments];

			$this->show('admin/comments', $params);
		}
	}

	public function supprComment($id)
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$commentsModel = new CommentsModel;
			if($deleteCom = $commentsModel->delete($id)){
				$this->redirectToRoute('admin_comments');
			};
			$this->show('admin/comments');
		}
	}


	public function messageConctact()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$contactModel = new ContactModel;
			$contact = $contactModel->findAll();

			$params = ['contact' => $contact];

			$this->show('admin/contact', $params);
		}
	}
}
