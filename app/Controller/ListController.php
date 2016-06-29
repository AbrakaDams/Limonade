<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\ListModel as ListModel;
use \Model\CardsModel as CardsModel;
use \Controller\EventController;

class ListController extends Controller
{

	/**
	 * Génère une liste
	 */
	public function addList() {
		$post = [];
		$inputMaxLength = 151; // restrict list name length

		// var_dump($_POST['eventId']);
		if(!empty($_POST)) {
			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}
			// if our name input exists in correst state
			if(isset($post['newList']) && !empty($post['newList']) && isset($post['eventId']) && !empty($post['eventId'])) {
				//$user = $this->getUser();
				$id = intval($post['eventId']);

				// create variable to prevent empty insertions
				$listName = $post['newList'];
				$timestamp = date('Y-m-d H:i:s');
				//form data to insert to the database
				$entryData = [
				  'title' 		=> $listName,
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

	/**
	 * Ajoute une chexbox
	 */
	public function addCard() {
		$post = [];
		$errors = [];
		$inputMaxLength = 151; // restrict list name length
		$responsible = 0;
		$idList = 0;
		$idEvent = 0;

		if(!empty($_POST)) {

			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}
			// if our name input exists in correst state
			if(!isset($post['card_title']) || empty($post['card_title'])) {
				$errors[] = 'Titre de la tache est incorrect';
			}
			if(!isset($post['card_desc']) || empty($post['card_desc'])) {
				$errors[] = 'Description de la tache est incorrect';
			}
			if(!isset($post['card_quantity']) || empty($post['card_quantity']) && $post['card_quantity'] < 0) {
				$errors[] = 'Quantite de la tache est incorrect';
			}
			if(!isset($post['card_price']) || empty($post['card_price']) || !is_numeric($post['card_price']) || $post['card_price'] < 0) {
				$errors[] = 'Prix de la tache est incorrect';
			}
			// create variable to prevent empty insertions
			if(isset($post['card_person']) && !empty($post['card_person'])) {
				$responsible = intval($post['card_person']);
			}
			else {
				$responsible = 0;
			}
			// check id of the event

			if(isset($post['eventId']) && !empty($post['eventId'])) {
				$idEvent = intval($post['eventId']);
			}
			else {
				$errors[] = 'Impossible inserer cette tache dans event';
			}
			// check id of the list
			if(isset($post['listId']) && !empty($post['listId'])) {
				$idList = intval($post['listId']);
			}
			else {
				$errors[] = 'Impossible inserer cette tache dans la liste';
			}
			// if input data is valid
			if(count($errors) == 0) {
				// current time for date_add
				$timestamp = date('Y-m-d H:i:s');
				//form data to insert to the database
				$entryData = [
				  'title' 			=> $post['card_title'],
				  'description' 	=> $post['card_desc'],
				  'quantity' 		=> $post['card_quantity'],
				  'price' 			=> $post['card_price'],
				  'id_user' 		=> $responsible,
				  'id_event' 		=> $idEvent,
				  'id_list' 		=> $idList,
				  'date_add'		=> $timestamp,
				];
				// call model
				$insertList = new CardsModel();
				// insert
				if($insertList->insert($entryData)) {
					$this->showJson(['answer' => 'success']);
				}
			}
			else {
				$this->showJson(['errors' => $errors, 'list' => $idList, 'event' => $idEvent]);
			}
		}
	}

	/**
	 * Récupere les listes
	 */
	public function getList() {

		//get id of event from ajax
		$id = intval($_POST['eventId']);

		//temporary time vars
		$lastDateLists = null;
		$lastDateCards = null;

		// define lastDate for the first time
		if(isset($_POST['myDate']) && !empty($_POST['myDate'])) {
			$lastDate = $_POST['myDate'];
		} else {
			$lastDate = 0;
		}

		$listsData = new ListModel();
		// get lists and cards
		$newLists = $listsData->findLists($id, $lastDate);
 		$newCards = $listsData->findCards($id, $lastDate);

		if(!empty($newLists)) {
			foreach ($newLists as $key => $value) {
				$lastDateLists = $value['date_add'];
			}
		}
		if(!empty($newCards)) {
			foreach ($newCards as $key => $value) {
				$lastDateCards = $value['date_add'];
			}
		}

		if( $lastDateLists != null && $lastDateCards != null) {
			if($lastDateLists > $lastDateCards) {
				$lastDate = $lastDateLists;
			}
			else {
				$lastDate = $lastDateCards;
			}
		}
		elseif($lastDateLists == null && $lastDateCards != null) {
			$lastDate = $lastDateCards;
		}
		elseif($lastDateLists != null && $lastDateCards == null) {
			$lastDate = $lastDateLists;
		}

		$this->showJson(['newLists' => $newLists, 'newCards' => $newCards, 'newDate' => $lastDate]);

	}

	public function deleteCard() {
		// just 0 so he can find nothing
		$idCard = 0;
		if(isset($_POST['idCard']) && !empty($_POST['idCard'])) {
			$idCard = intval($_POST['idCard']);
		}

		$deleteCard = new ListModel();
		if($deleteCard->delete($idCard)) {
			$this->showJson(['delete' => 'done']);
		}
	}
}
