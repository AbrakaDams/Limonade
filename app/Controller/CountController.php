<?php /* app/Model/CommentModel.php */
namespace Controller;

use \W\Controller\Controller;
use \Model\CountModel as CountModel;
use \Controller\EventController;

class CountController extends Controller
{
	/**
	* Gestion des budget
	*/
	public function ourAccounts()
	{
		$post = [];
		$errors = [];
		$success = null;


		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}
			if (strlen($post['personn']) < 2 || strlen($post['personn']) > 12){
				$errors[] = 'Votre prénom doit contenir entre 2 et 12 caractères';
			}
			if (strlen($post['purchase']) < 2 || strlen($post['purchase']) > 13){
				$errors[] = 'Votre article doit contenir entre 2 et 13 caractères';
			}

			if (!int($post['quantity'])){
				$errors[] = 'Votre article doit être un chiffre';
			}

			if (!int($post['price'])){
				$errors[] = 'Votre prix doit être un chiffre';
			}
			if(count($errors) === 0){
				// Ici il n'y a pas d'erreurs, on peut donc enregistrer en base de données
				$countModel = new CountModel();
				//on utilise la méthode insert() qui permet d'insérer des données en bases
				$data = [
					//la clé du tableau correspond au nom de la colone SQL
					'personn' 		=> $post['personn'],
					'purchase' 	=> $post['purchase'],
					'quantity' => $post['quantity'],
					'price' 	=> $post['price'],
				];
				$countModel->insert($data);
			}//fin if count
		}//if!empty post
			$params = [
			'errors' 	=> $errors,
			'success' 	=> $success,
		];
		$this->show('count/ourAccounts', $params);
	}//fin public function
}

?>
