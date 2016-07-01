<?php

namespace Controller;

use \Controller\MasterController;
use \Model\EventModel as EventModel;

class SearchController extends MasterController
{
	/**
	 * Méthode pour searchResult
	 */

	public function searchResult()
	{		
		if(!empty($_GET) && isset($_GET['search'])){

			$keyword = trim(strip_tags($_GET['search']));
			$eventModel = new EventModel();

			$data =[
				'title' 	=> $keyword,
				'category'	=> $keyword,
			];
			

			$param = ['search' => $eventModel->search($data)];
		}

		$this->showWithNotif('event/search_result', $param);
	}
}