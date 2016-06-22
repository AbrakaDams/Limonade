<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UserModel as UserModel; // permet d'importerla classe UsersModel que l'on pourra instancier via UsersModel();
use \W\Security\AuthentificationModel as AuthModel; 

class UserController extends Controller
{ 
/**
	 * Méthode pour accès inscription
	 */
	public function register()
	{
		$post = [];
		$errors = [];
		$success = false;
		$successimg = false;
		$adress = ''; //adress est visible pour toute la fonction

		//qd j'insère le fichier depuis mon formulaire ça le place dan assets
		$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/avatar';
		$dbLink = '/limonade/public/assets/avatar';
		$maxSize = 1000000 * 5; // 5 Mo => taille maximale de mon fichier

		if(!empty($_FILES) && isset($_FILES['avatar'])){

			$nomFichier = $_FILES['avatar']['name']; // Récupère le nom de mon fichier
			$tmpFichier = $_FILES['avatar']['tmp_name']; // Stockage temporaire du fichier
			$newFichier = $folder.$nomFichier; // Créer une chaine de caractère contenant le nom du dossier de destination et le nom du fichier final
			// Permet de vérifier que la taille du fichier est inférieure ou égale à $maxSize
			if($_FILES['avatar']['size'] <= $maxSize){
				/*
				 * move_uploaded_file() retourne un booleen :
				 *	- true si le fichier a bien été déplacé/envoyé
				 *  - false si il y a une erreur
				 */
				if(move_uploaded_file($tmpFichier, $newFichier)){
					$successimg = true;
					$adress = $dbLink.'/'.$nomFichier;
				}
				else {
					$error = 'Erreur lors de l\'envoi du fichier';
				}
			}
		}

		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}
			if (strlen($post['firstname']) < 2){
				$errors[] = 'Votre prénom doit contenir au moins 2 caractères ';
			}
			if (strlen($post['username']) < 2){
				$errors[] = 'Votre nom doit contenir au moins 2 caractères ';
			}
			if (strlen($post['password']) < 8){
				$errors[] = 'Votre mot de passe doit contenir au moins 8 caractères ';
			}
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
				$errors[] = 'Votre adresse email est vide';
			}
			if(count($errors) === 0){
				// Ici il n'y a pas d'erreurs, on peut donc enregistrer en base de données
				$userModel = new UserModel();
				$authModel = new AuthModel();

				//on utilise la méthode insert() qui permetd d'insérer des données en bases
				$data = [
					//la clé du tableau correspond au nom de la colone SQL
				'username' => $post['username'],
				'email' => $post['email'],
				'password' => $authModel->hashPassword($post['password']),
				'avatar' => $adress,
				];
				// on passe le tableau $data à la méthode insert() pour enregistrer nos données en base.
				$usersModel->insert($data);
				// ici l'insertion en base est effectuée!
				$success =  true;
			}
			else {
				// On peut faire un truc ici..........
			}
		}
		# On envoi les erreurs en paramètre à l'aide d'un tableau (array)
		$params = ['errors' => $errors, 'success' => $success, 'successimg' => $successimg, 'adress' => $adress];
		$this->show('default/register', $params);
	}
}

	