<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;

class SearchController extends Controller
{
	/**
	 * Méthode pour searchbar
	 */

	public function searchResult()
	{		
		if(!empty($_GET) && isset($_GET['search'])){

			$keyword = trim(strip_tags($_GET['search']));
			$searchBar = new EventModel();


			$data =[
				'title' => $keyword,
			];
			var_dump($data);
			

			$param = ['search' => $searchBar->search($data)];
		}
		$this->showWithNotif('event/search-result', $param);
	}
}