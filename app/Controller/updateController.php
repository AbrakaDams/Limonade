<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel as UsersModel; // permet d'importerla classe UsersModel que l'on pourra instancier via UsersModel();
use \W\Security\AuthentificationModel as AuthModel;
use \Model\TokensModel as TokenModel;
use PHPMailer;

class UpdateController extends Controller
{
	public function updateUser(){
logged_only();
// On instancie nos variables qu'on utilisera plus tard
$post = array();
$error = array();
$displayErr = false;
$formValid = false;

	// On vérifie que notre formulaire n'est pas vide
	if(!empty($_POST)){
		// On recréer le tableau en le nettoyant des espaces vides en début et fin de chaine
		// et de l'éventuel code HTML / PHP
		foreach($_POST as $key => $value){
			$post[$key] = trim(strip_tags($value));
		}

		if(strlen($post['adress']) < 4 || strlen($post['adress']) > 200){
			$error[] = 'not an adress';
		}

		if(count($error) > 0){
			$displayErr = true;
		}
			else {

				// Ici je suis sur de ne pas avoir d'erreurs, donc je peux faire du traitement.
				$res = $db->prepare('UPDATE img_header SET img1 = :img1, img2 = :img2, img3 = :img3, adress = :adress WHERE id = 1');
				
				// On complète les champs
				$res->bindValue(':img1', $post['img1']);
				$res->bindValue(':img2', $post['img2']);
				$res->bindValue(':img3', $post['img3']);
				$res->bindValue(':adress', $post['adress'], PDO::PARAM_STR);


				// retourne un booleen => true si tout est ok, false sinon
				if($res->execute()){
					// Pour afficher le message de réussite si tout est bon
					$formValid = true;
				}
				else {
					// Permettra d'afficher les erreurs éventuelles
					die(print_r($res->errorInfo()));
				}
			}//fin de 1er else
		}//fin de if not empty $POST

	// Prépare et execute la requète SQL pour récuperer notre nveau $changeprofil
	$res = $db->prepare('SELECT * FROM img_header WHERE id = 1');
	$res->execute();

	// $changeprofil contient mon article extrait de la bdd
	$changeprofil = $res->fetch(PDO::FETCH_ASSOC);

	if($formValid){ // Si tout est ok, on affiche notre victoire !
		echo '<p style="color:green;"> GREAT !!</p>';
	}

	if($displayErr){ // Si on a des erreurs, on les affiche
		echo '<div class="errorContent">';
		echo implode('<br>', $error); // Permet de convertir le tableau $error en chaine de caractère
		echo '</div>';
	}
}