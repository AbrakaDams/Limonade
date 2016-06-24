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

<<<<<<< 3030f4cb5dbe5115f03b74700a80448fd90a5b54
	public function createEvent()
	{
		$post = array();
		$errors = array();
		$displayError = false;
		$formValid = false;

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
			if(!empty($post['adress'])){
			  	$errors[] = 'Veuillez indiquer une adresse';
			}
					function is_valid_date_start($value, $format = 'dd.mm.yyyy'){
			    		if(strlen($value) >= 6 && strlen($format) == 10){

			        		// trouve les séparateurs
			        		$separator_only = str_replace(array('m','d','y'),'', $format);
			        		$separator = $separator_only[0]; // separateur 1er caractère

			        		if($separator && strlen($separator_only) == 2){
					            // make regex
					            $regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
					            $regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
					            $regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
					            $regexp = str_replace($separator, "\\" . $separator, $regexp);
				            	if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){

					                // verif format date
					                $arr=explode($separator,$value);
					                $day=$arr[0];
					                $month=$arr[1];
					                $year=$arr[2];
					                if(@checkdate($day, $month, $year))
					                    return true;
				            	}
			        		}
			    		} return false;
					}
					function is_valid_date_end($value, $format = 'dd.mm.yyyy'){
			    		if(strlen($value) >= 6 && strlen($format) == 10){

			        		// On trouve les séparateurs
			        		$separator_only = str_replace(array('m','d','y'),'', $format);
			        		$separator = $separator_only[0]; // sseparateur du 1er caractères

				        	if($separator && strlen($separator_only) == 2){
					            // créa regex
					            $regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
					            $regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
					            $regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
					            $regexp = str_replace($separator, "\\" . $separator, $regexp);
					            if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){

					                // verif format date
					                $arr=explode($separator,$value);
					                $day=$arr[0];
					                $month=$arr[1];
					                $year=$arr[2];
					                if(@checkdate($day, $month, $year))
					                    return true;
			            		}
			        		}
			    		} return false;
					}
					if(count($errors) > 0){
			  			$displayError = true;
					}
					else {
						$formValid= true;

						$req = $db->prepare('INSERT INTO event(role, category, title, description,adress, date_start, date_end)
							VALUES(:role, :category, :title, :description, :adress, :date_start, :date_end)');

						$req->bindValue(':role', $post['role']);
						$req->bindValue(':category', $post['category']);
						$req->bindValue(':title', $post['title']);
						$req->bindValue(':description', $post['description']);
						$req->bindValue(':adress', $post['adress']);
						$req->bindValue(':date_start', $post['date_start']);
						$req->bindValue(':date_end', $post['date_end']);

						if($success = $req->execute()){
							echo '<p class="alert alert-success">Votre événement a bien été créée, nous allons vous envoyer un email pour vous confirmer votre événement';
						}
					}
					if($displayError){
						echo '<p class="alert alert-danger">' .implode('<br>', $error). '<p>';
					}
				}
				$this->show('event/create');
			}

}
