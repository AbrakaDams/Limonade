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
	* Gestion des budget
	*/
	public function ourAccounts()
	{
		$post = [];
		$inputMaxLength = 151; // restrict list name length

		if(!empty($_POST)) {
			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			// if our name input exists in correst state
			if(isset($post['personn']) && !empty($post['personn']) && strlen($post['personn']) < $inputMaxLength) {

				$user = $this->getUser();
				$id = $user['id'];
				// create variable to prevent empty insertions
				$listName = $post['personn'];

				//form data to insert to the database
				$entryData = ['personn' 		=> $personn,
							  'purchase' 	=> $purchase,
							  'quantity'	=> $quantity,
							  'price'	=> $price,
							 ];
				// call model
				$insertList = new ListModel();
				// insert
				if($insertList->insert($entryData)) {
					$this->showJson(['answer' => 'success']);
				}
			}
		}
	}
}

?>
