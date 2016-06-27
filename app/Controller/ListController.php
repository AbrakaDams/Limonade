<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\ListModel as ListModel;
use \Controller\EventController;

class ListController extends Controller
{

	public function addList() {
		$post = [];
		$inputMaxLength = 151; // restrict list name length

		if(!empty($_POST)) {
			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			// if our name input exists in correst state
			if(isset($post['newList']) && !empty($post['newList']) && strlen($post['newList']) < $inputMaxLength) {

				$user = $this->getUser();
				$id = $user['id'];
				// create variable to prevent empty insertions
				$listName = $post['newList'];
				$timestamp = date('Y-m-d H:i:s');
				//form data to insert to the database
				$entryData = ['title' 		=> $listName,
							  'id_event' 	=> $id,
							  'date_add'	=> $timestamp,
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

	public function getList() {

		$id = $_POST['eventId'];
		// 	$newLists = new ListModel();
		// 	$lists = $newLists->findLists($id);
		//if()$lastDate = $_POST['myDate'];
		if(isset($_POST['myDate']) && !empty($_POST['myDate'])) {
			$lastDate = $_POST['myDate'];
		} else {
			$lastDate = 0;
		}
		// var_dump($_POST);
		// $lists = array();

		$listsData = new ListModel();
		$newLists = $listsData->findLists($id, $lastDate);

		$newCards = $listData->findCards($id, $lastDate);

		foreach($newLists as $key => $value){
			$lastDate = $value['date_add'];
		}

		//var_dump($sql);
		$this->showJson(['newList' => $newLists, 'newDate' => $lastDate]);

	}

}
