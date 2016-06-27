<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;

class AdminController extends Controller
{
	/**
	 * Si il n'y a personne de connecter on rediriger vers la page d'accueil
	 * Sinon on regarde si le role = 'admin'
	 * Si user = redirige vers error 403
	 * Si admin = affichage du back_office
	 */
	public function admin()
	{
		$loggedUser = $this->getUser();
		if(!isset($loggedUser)){
			$this->redirectToRoute('default_home');
		}
		else{
			$this->allowTo('admin');
			$this->show('admin/index');}
	}
}
