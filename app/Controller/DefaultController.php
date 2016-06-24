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
		if(!isset($loggedUser)){
			// non connecté
			$this->show('default/home');
		}else{
			// Connecté
			$this->show('default/home_logged');
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
