<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\ListModel as ListModel;


class ListController extends Controller
{
	public function showLists($id) {
		$newLists = new ListModel();
		$lists = $newLists->findLists($id);

		return $lists;
	}

	public function addList($id) {
		$post = [];
		$inputMaxLength = 151; // restrict list name length

		if(!empty($_POST)) {
			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			// if our name input exists in correst state
			if(isset($post['newList']) && !empty($post['newList']) && strlen($post['newList']) < $inputMaxLength) {
				// create variable to prevent empty insertions
				$listName = $post['newList'];
				//form data to insert to the database
				$insertData = ['title' 		=> $listName,
							   'id_event' 	=> $id,
							  ];
				// call model
				$insertList = new ListModel();
				// insert
				$insertList->insert($insertData);

				// This is our new stuff
			    $context = new ZMQContext();
			    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
			    $socket->connect("tcp://localhost:5555");

			    $socket->send(json_encode($entryData));
			}
		}
	}
}
