<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{

		$loggedUser = $this->getUser();
		if(empty($loggedUser)){
			// Non connecté

			$this->show('default/home');
		}
		else{
			// Connecté

			$this->show('default/home_logged');
			//$this->redirectToRoute('default_index');
		}
	}


	/**
	 * Page Contact par défaut
	 */
	public function contact()
	{
		$this->show('default/contact');
	}


}
