<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\ListModel as ListModel;

use \Controller\GetListsController;

class ListController extends Controller
{
	public function showLists($id) {
		$newLists = new ListModel();
		$lists = $newLists->findLists($id);

		return $lists;
	}

	// public function getList() {
    //     set_time_limit(0);
    //     // where does the data come from ? In real world this would be a SQL query or something
    //     //$data_source_file = 'data.txt';
    //     // main loop
    //     while (true) {
    //         // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
    //         $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;
    //         // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
    //         clearstatcache();
    //         // get timestamp of when file has been changed the last time
    //         $last_change_in_data_file = filemtime($data_source_file);
    //         // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
    //         if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {
    //             // get content of data.txt
    //             $data = file_get_contents($data_source_file);
    //             // put data.txt's content and timestamp of last data.txt change into array
    //             $result = array(
    //                 'data_from_file' => $data,
    //                 'timestamp' => $last_change_in_data_file
    //             );
    //             // encode to JSON, render the result (for AJAX)
    //             $json = json_encode($result);
    //             echo $json;
    //             // leave this loop step
    //             break;
    //         } else {
    //             // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
    //             sleep( 1 );
    //             continue;
    //         }
    //     }
    //     // $this->show('event/event');
    // }


	public function addList() {
		$post = [];
		$inputMaxLength = 151; // restrict list name length

		//$this->showJson(['output' => 'helloworld']);

		if(!empty($_POST)) {
			// clean received data
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			// if our name input exists in correst state
			if(isset($post['newList']) && !empty($post['newList']) && strlen($post['newList']) < $inputMaxLength) {

				$user = $this->getUser();
				var_dump($user);
				$id = $user['id'];
				// create variable to prevent empty insertions
				$listName = $post['newList'];
				//form data to insert to the database
				$entryData = ['title' 		=> $listName,
							   'id_event' 	=> $id,
							  ];
				// call model
				$insertList = new ListModel();
				// insert
				if($insertList->insert($entryData)) {
					$this->showJson(['output' => 'success', 'dump' => $user['id']]);
				}


			}
		}
	}

}
