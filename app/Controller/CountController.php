<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\ListModel as CountModel;
use \Controller\EventController;

class CountController extends Controller
{
		/**
	* Gestion des budget
	*/
	public function ourAccounts()
	{
		
		$this->show('count/ourAccounts');
	}
}

?>