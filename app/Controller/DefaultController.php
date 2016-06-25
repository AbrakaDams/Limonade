<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;
use \Model\ContactModel as Contact;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut Si non-connecter  Sinon page accueil connecter
	 */
	public function home()
	{
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			// non connecté
			$this->show('default/home');
		}else{
			// Connecté
			$event = new EventModel();
			$eventData = $event->findAll($orderBy = 'date_start', $orderDir = 'DESC', $limit = 3);

			$showEvent = ['thisEvent' => $eventData,
			];
			$this->show('default/home_logged', $showEvent);
		}
	}

	/**
	 * Page Contact de l'équipe
	 */
	public function team()
	{
		$this->show('default/team');
	}

	/**
	 * Page Contact
	 */

	public function contact()
	{
		$post = array();
		$errors = array();
		$success = null;


		if(!empty($_POST)){
	  		foreach ($_POST as $key => $value) {
	    		$post[$key] = trim(strip_tags($value));
	  		}
		
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Votre adresse email n\'est pas valide';
			}

			if (strlen($post['name']) < 2 || strlen($post['name']) > 12){
				$errors[] = 'Votre nom doit comporter entre 2 et 12 caractères';
			}

			if (strlen($post['object']) < 6 || strlen($post['object']) > 30){
				$errors[] = 'Votre objet doit comporter entre 6 et 30 caractères';
			}

			if (strlen($post['content']) < 10){
				$errors[] = 'Votre objet doit comporter entre 6 et 30 caractères';
			}

			if(count($errors) === 0){
	  			// Il n'y a pas d'erreurs on fait l'insertion SQL
	  			$contactModel = new Contact();


	  			$data = [
	  				'name' => $post['name'],
	  				'email'     => $post['email'],
	  				'object'     => $post['object'],
	  				'content' => $post['content'],
	  	
	  			];
	  			$contactModel->insert($data);

		}

		$params = [
			'errors' 	=> $errors,
			'success' 	=> $success,
		];

		$this->show('default/contact');

	}


}
