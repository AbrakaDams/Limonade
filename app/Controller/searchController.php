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
		$param = ['search' => 'no result'];
		if(!empty($_GET) && isset($_GET['search'])){

			$keyword = trim(strip_tags($_GET['search']));
			$searchBar = new EventModel();


			$data =[
				'title' => $keyword,
			];
			

			$param = ['search' => $searchBar->search($data)];
		}
			var_dump($data);

		$this->showWithNotif('event/search-result', $param);
	}
}