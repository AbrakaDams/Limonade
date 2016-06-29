<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;

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

	/**
	* Function pour modifier un event
	*/
	public function checkEvent()
	{
		$post = array();
		$errors = array();
		$success = false;
		$date_start = '';
		$date_end = '';
		$newEvent = '';

		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}
			if(strtotime($post['date_start']) > strtotime($post['date_end'])){
				$errors[] = 'La date de début ne peut être supérieure à la date de fin';
			}
			if(empty($post['role'])){
				$errors[] = 'Vous devez cocher un bouton !';
			}
			if(empty($post['category'])){
				$errors[] = 'Vous devez cocher un bouton !';
			}
			if(strlen($post['title']) < 3 || strlen($post['title']) > 20){
				$errors[] = 'Le titre de votre évènement doit contenir entre 3 et 20 caractères';				
			}
			if(strlen($post['description']) < 5 || strlen($post['description']) > 200){
				$errors[] = 'La description doit contenir minimum 5 caractères';
			}
			if(empty($post['address'])){
				$errors[] = 'Veuillez indiquer une adresse correcte';
			}
			$date_start = $post['date_start']. ' '.$post['time_start'].':00';
			if($this->validateDate($date_start) === false){
				$errors[] = 'La date de début n\'est pas au bon format';
			}
			
			$date_end = $post['date_end'].' '.$post['time_end'].':00';
			if($this->validateDate($date_end) === false){
				$errors[] = 'La date de fin n\'est pas au bon format';
			}
			if(count($errors) === 0){

				$eventModel = new EventModel();
				$EventUsersModel = new EventUsersModel();

				$date = [
					'id'            => $id,
					'category' 		=> $post['category'],
	  				'role'     		=> $post['role'],
	  				'title'     	=> $post['title'],
	  				'description'   => $post['description'],
	  				'address' 		=> $post['address'],
	  				'date_start' 	=> $date_start,
	  				'date_end' 		=> $date_end,
				];

				$newEvent = $eventModel->insert($data);
				if($EventUsersModel->insert($dataEvent)){
					$success = true;
				}
				else{
					echo $errors[] = 'Il y a eu une erreur dans la création de l\'évènement !';
				}				
			}
		}
		$prams = [
			'errors'   => $errors,
			'success'  => $success,
			'newEvent' => $newEvent,
		];
		$this->show('admin/checkEvent', $params);
	}

}
