<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel as EventModel;

class searchController extends Controller
{
/**
	 * Méthode pour searchbar
	 */

	// Effectue une recherche
	// Le premier argument est un tableau associatif où la clé correspond à la colonne SQL
	// Le second argument est l'opérateur OR ou AND pour la recherche

	public function search()
	{
		if(!empty($_GET) && isset($_GET['search'])){

			$keyword = trim(strip_tags($_GET['search']));
			$search = new EventModel();

			$data =[
			'title' => $keyword,
			];

			if($search->search($data)){

				//redirige l'utilisateur vers la page des searchView
				/*$this->redirectToRoute('event_search');*/
			}
		}
		$this->show('event/search'); 

	}