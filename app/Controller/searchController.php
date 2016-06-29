<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;

class searchController extends Controller
{
/**
	 * Méthode pour searchbar
	 */

	public function searchBar(keyword)
	{

		if(!empty($_GET) && isset($_GET['search'])){

			$keyword = trim(strip_tags($_GET['search']));
			$searchBar = new EventModel();

			$data =[
			'title' => $keyword,
			];

			var_dump($data);

			$searchBar->search($data);
		}
		$this->show('event/search', $data); 

	} 