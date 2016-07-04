<?php
namespace Controller;

use \Controller\MasterController;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;
use \Model\ContactModel as Contact;


class ContactController extends MasterController
{
	/**
	 * traitement formulaire contact
	 */
	public function contact(){
			$post = array();
			$errors = array();
			$success = false;

			if(!empty($_POST)){
		  		foreach ($_POST as $key => $value) {
		    		$post[$key] = trim(strip_tags($value));
		  		}
				if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
					$errors[] = 'Votre adresse email n\'est pas valide';
				}
				if (strlen($post['name']) < 2 || strlen($post['name']) > 18){
					$errors[] = 'Votre nom doit comporter entre 2 et 18 caractères';
				}
				if (strlen($post['object']) < 6 || strlen($post['object']) > 30){
					$errors[] = 'Votre objet doit comporter entre 6 et 30 caractères';
				}
				if (strlen($post['content']) < 10){
					$errors[] = 'Votre contenu doit comporter entre 6 et 30 caractères';
				}
				if(count($errors) === 0){
		  			// Il n'y a pas d'erreurs on fait l'insertion SQL
		  			$contactModel = new Contact();
					$timestamp = date('Y-m-d H:i:s');

		  			$data = [
		  				'name' 			=> $post['name'],
		  				'email'     => $post['email'],
	  					'object'    => $post['object'],
		  				'content' 	=> $post['content'],
						'date_add'	=> $timestamp,
		  			];
		  			if($contactModel->insert($data))
						{
							$success = true;
						}
			}
		}
		$params = [
				'errors' 	=> $errors,
				'success' 	=> $success,
		];
		$this->showWithNotif('default/contact', $params);
	}
}
