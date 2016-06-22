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
}
