<?php

/**
 * Ce controller recréer une méthode show() pour transmettre les notifications à la vue
 * Il étend le controller de W
 */

namespace Controller;

use \W\Controller\Controller;
use \Model\NotificationsModel;

class MasterController extends Controller {


	/**
	 * Affiche un template avec les notifications
	 * @param string $file Chemin vers le template, relatif à app/Views/
	 * @param array  $data Données à rendre disponibles à la vue
	 */
	public function showWithNotif($file, array $data = array())
	{
		//incluant le chemin vers nos vues
		$engine = new \League\Plates\Engine(self::PATH_VIEWS);

		//charge nos extensions (nos fonctions personnalisées)
		$engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		$app = getApp();

		$notificationsModel = new NotificationsModel();

		$connectedUser = $this->getUser();
		if(!empty($connectedUser)){
			$idUser = $connectedUser[$app->getConfig('security_id_property')];
			$notifications = $notificationsModel->findAllByUser($idUser);
		}
		else {
			$notifications = 0;
		}

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
				'w_notifications' => $notifications,
			]
		);

		// Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $engine->render($file, $data);
		die();
	}
}