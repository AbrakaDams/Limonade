<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel as UsersModel; // permet d'importerla classe UsersModel que l'on pourra instancier via UsersModel();
use \W\Security\AuthentificationModel as AuthModel;
use \Model\TokensPasswordModel as TokensPasswordModel;
use \Model\TokensRegisterModel as TokensRegisterModel;
use PHPMailer;

class UserController extends Controller
{

	/**
	 * Function pour enregistrer l'utilisateur via formulaire
	 */
	public function register()
	{
		// Si il est conecter on le redirige
		$loggedUser = $this->getUser();

		if(isset($loggedUser)){
			//connecté
			$this->redirectToRoute('default_home');
		}else{

			$post = [];
			$errors = [];
			$success = false;
			$successimg = false;
			$adress = ''; //adress est visible pour toute la fonction



			//qd j'insère le fichier depuis mon formulaire ça le place dan assets
			$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/image/';
			$dbLink = '/limonade/public/assets/image';
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

				if (strlen($post['firstname']) < 2 || strlen($post['firstname']) > 12){
					$errors[] = 'Votre prénom doit contenir entre 2 et 12 caractères';
				}

				if (strlen($post['lastname']) < 2 || strlen($post['lastname']) > 13){
					$errors[] = 'Votre nom doit contenir entre 2 et 13 caractères';
				}

				if (empty($post['password']) || $post['password'] != $post['password_confirm']){
					$errors[] = 'Votre mot de passe n\'est pas identique';
				}

				if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
					$errors[] = 'Votre adresse email n\'est pas valide';
				}

				if(!isset($_FILES['avatar']) && !filter_var($post['url'], FILTER_VALIDATE_URL)){
					$errors[] = 'Vous devez choisir un avatar pour continuer';
				}

				if (strlen($post['username']) < 3 || strlen($post['username']) > 18){
					$errors[] = 'Votre pseudo doit contenir entre 3 et 18 caractères';
				}

				if(count($errors) === 0){
					// Ici il n'y a pas d'erreurs, on peut donc enregistrer en base de données
					$usersModel = new UsersModel();
					$authModel = new AuthModel();

					//on utilise la méthode insert() qui permet d'insérer des données en bases
					$dataUser = [
						//la clé du tableau correspond au nom de la colone SQL
						'username' 	=> $post['username'],
						'firstname' => $post['firstname'],
						'lastname' 	=> $post['lastname'],
						'email' 	=> $post['email'],
						'password' 	=> $authModel->hashPassword($post['password']),
						'role' 		=> 'user',
						'avatar' 	=> $adress,
						'url' 		=> $post['url'],
						'activation'=> 'false',
					];
					// On prépare l'insertion token
					$date_create = date('Y-m-d h:i:s');
					$date_exp = date('Y-m-d h:i:s',strtotime('+2 days'));
					$token = md5(uniqid());

					$dataToken = [
						//la clé du tableau correspond au nom de la colone SQL
	    				'email' 		=> $post['email'],
	    				'token' 		=> $token,
	    				'date_create' 	=> $date_create,
	    				'date_exp' 		=> $date_exp,
					];
					// On instancie la class de tokenRegisterModel
					$tokenRegisterModel = new TokensRegisterModel();
					// on passe le tableau $data à la méthode insert() pour enregistrer nos données en base.
					// Et on ajoute le token dans la table token_register
					if($usersModel->insert($dataUser) && $tokenRegisterModel->insert($dataToken)){
						// ici l'insertion en base est effectuée!

						$userInserted = $usersModel->getUserByUsernameOrEmail($dataUser['email']);
						echo $userInserted['id'];

						$success =  true;
						$mail = new PHPMailer;
						//$mail->SMTPDebug = 3;                               // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'mailtrap.io';					  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'f12564c2d967d2';           // SMTP username
						$mail->Password = 'f693c45ea37fa0';                 // SMTP password
						$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to

						$mail->setFrom('limowf3@yopmail.com');
						$mail->addAddress($dataUser['email'], $dataUser['username']);      // Name is optional
						//$mail->addReplyTo('info@example.com', 'Information');

						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Valider votre compte';
						$mail->Body    =  $dataUser['username'].' Afin de valider votre compte merci de cliquer sur ce lien http://localhost/limonade/public/registerConfirm?email='.$dataToken['email'].'&token='.$token;
						$mail->AltBody = $dataUser['username'].' Afin de valider votre compte merci de cliquer sur ce lien http://localhost/limonade/public/registerConfirm?email='.$dataToken['email'].'&token='.$token;

						if(!$mail->send()) {
								echo 'Message could not be sent.';
								echo 'Mailer Error: ' . $mail->ErrorInfo;
						} else {
								echo 'Message has been sent';
						}

						//redirige l'utilisateur vers la page d'accueil
						//$this->redirectToRoute('user_login');
					} //Fin insertion USER et TOKEN
					else{
						$errors[] = 'Problème lors de l\'insertion';
					}
				}//count error

			}//if empty post
			# On envoi les erreurs en paramètre à l'aide d'un tableau (array)

			$params = ['errors' => $errors, 'success' => $success, 'successimg' => $successimg, 'adress' => $adress];
			$this->show('user/register', $params);
		}
	}//fin de function function register


	/**
	 * Function Pour comfirmer le compte
	 */
	public function registerConfirm(){

		$error = [];
		$validation = false;

		if(isset($_GET['token']) &&
		!empty($_GET['token']) &&
		isset($_GET['email']) &&
		!empty($_GET['email'])){

			// On récupère et nétoie les valeur des GET
			foreach ($_GET as $key => $value) {
          $get[$key] = trim(strip_tags($value));
      }
      // On récupère l'email et le token dans une varialbe
      $email = $get['email'];
      $token = $get['token'];
	    // On instancie la class tokensPasswordModel
			$tokensRegisterModel = new TokensRegisterModel();
	    // On vérifie que le token et l'email sont bien dans la base de données
    	$tokenExist = $tokensRegisterModel->findTokenRegister($email, $token);

			if(!empty($tokenExist) && ($tokenExist['date_exp'] > date('Y-m-d H:i:s'))) {
    			// Ici le token est valide et n'a pas expiré, on peut donc activer le compte.
    			// On instancie la classe userModel
    			$usersModel = new UsersModel();
    			// On récupère les info de la table user grace à son adresse mail pour modifier la valeur du champ activation
    			$infoUser = $usersModel->getUserByUsernameOrEmail($get['email']);
					$data = [
						'activation' => 'true'
					];
    			// On active enfin le compte
    			if($usersModel->update($data, $infoUser['id'])){
    				// Le compte est activé, on supprime donc le token
    				if($tokensRegisterModel->delete($tokenExist['id'])){
    					echo 'Tout est ok : Supression du token et activation du compte';
    				}
    			}
			}
			if($tokenExist['date_exp'] < date('Y-m-d H:i:s')){
				$error[] = 'Le lien n\'est plus valide ou votre compte est déja activé.' ;
			}
		}
		$this->show('user/registerConfirm');
	}

	/**
	 * Fonction Permettant de se connecter via facebook
	 */
	public function loginFacebook(){

		//on s'identifie vers l'api facebook et on est redirigé vers loginhelper
		$fb = new \Facebook\Facebook([
		'app_id' => '602369446588975',
		'app_secret' => 'dd68c176483e918625b46de16c01419e',
		'default_graph_version' => 'v2.2',
		]);

		$helper = $fb->getRedirectLoginHelper();

		// Build URL for callback
		$urlRedirect = 'http://'.$_SERVER['HTTP_HOST'].$this->generateUrl('user_fbCallBack');
		$permissions = ['email']; // Optional permissions


		$urlFacebook = $helper->getLoginUrl($urlRedirect, $permissions);

		$this->redirect($urlFacebook);
	}
	
	/**
	 * Fonction Permettant de revenir depuis fb au site web
	 */
	public function fbCallBack(){

		 $data = [];
		 $success = false;

		 $fb = new \Facebook\Facebook([
	      'app_id' => '602369446588975', // Replace {app-id} with your app id
	      'app_secret' => 'dd68c176483e918625b46de16c01419e',
	      'default_graph_version' => 'v2.2',
	      ]);

	    $helper = $fb->getRedirectLoginHelper();

	    try {
	      $accessToken = $helper->getAccessToken();
	    }
	    catch(\Facebook\Exceptions\FacebookResponseException $e) {
	      // When Graph returns an error
	      echo 'Graph returned an error: ' . $e->getMessage();
	      exit;
	    }
	    catch(\Facebook\Exceptions\FacebookSDKException $e) {
	      // When validation fails or other local issues
	      echo 'Facebook SDK returned an error: ' . $e->getMessage();
	      exit;
	    }
	    if (!isset($accessToken)) {
	      if ($helper->getError()) {
	        header('HTTP/1.0 401 Unauthorized');
	        echo "Error: " . $helper->getError() . "\n";
	        echo "Error Code: " . $helper->getErrorCode() . "\n";
	        echo "Error Reason: " . $helper->getErrorReason() . "\n";
	        echo "Error Description: " . $helper->getErrorDescription() . "\n";
	      }
	      else {
	        header('HTTP/1.0 400 Bad Request');
	        echo 'Bad request';
	      }
	      exit;
	    }

	    // Logged in
	    echo '<h3>Access Token</h3>';
	    var_dump($accessToken->getValue());


	    // The OAuth 2.0 client handler helps us manage access tokens
	    $oAuth2Client = $fb->getOAuth2Client();

	    // Get the access token metadata from /debug_token
	    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
	    echo '<h3>Metadata</h3>';
	    var_dump($tokenMetadata);

	    // Validation (these will throw FacebookSDKException's when they fail)
	    $tokenMetadata->validateAppId('602369446588975'); // Replace {app-id} with your app id
	    // If you know the user ID this access token belongs to, you can validate it here
	    //$tokenMetadata->validateUserId('123');
	    $tokenMetadata->validateExpiration();

	    if(!$accessToken->isLongLived()) {
	      // Exchanges a short-lived access token for a long-lived one
	      try {
	        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	      } catch (Facebook\Exceptions\FacebookSDKException $e) {
	        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
	        exit;
	      }

	      echo '<h3>Long-lived</h3>';
	      var_dump($accessToken->getValue());
	    }

	    $_SESSION['fb_access_token'] = (string) $accessToken;

  	    // Pour récuperer l'user, l'accessToken est obligatoire
	    $response = $fb->get('/me?fields=id,name,email', $accessToken->getValue());
	    $user = $response->getGraphUser();

	    $usersModel = new UsersModel();
	    

	    if(!empty($user)){
	    	$data = [ 
	    		'id' => $user['id'],
	    		'username' => $user['name'],
	    		'email' => $user['email'],
	    	];
	    }
	    ;

	   if($user = $usersModel->insert($data)){
	  		$success = true;
	  		$this->redirectToRoute('default_home');

	  	}
	  	else{
	  		echo $errors[] = 'erreur lors de la création du profil';
	  	}
	
	    // User is logged in with a long-lived access token.
	    // You can redirect them to a members-only page.
	    //header('Location: https://example.com/members.php');
	}

	/**
	 * Fonction Permettant de se connecter
	 */
	public function login(){
		// Si il est conecter on le redirige
		$loggedUser = $this->getUser();

		if(isset($loggedUser)){
			//connecté
		$this->redirectToRoute('default_home');
		}else{
			$post = [];
			$errors = [];
			if(!empty($_POST)){
				// On nettoie les données...c'est l'équivalent de notre foreach
				$post = array_map('strip_tags', $_POST);
				$post = array_map('trim', $post);

				if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
					$errors[] ='Vous devez saisir une adresse email valide';
				}
				if(empty($post['password'])){
					$errors[] ='Vous devez saisir un mot de passe';
				}
				if(count($errors) === 0){
					// On instancie la classe UsersModel qui étends la classe model
					$usersModel = new UsersModel();
					$authModel = new AuthModel();

					// La méthode isValidLoginInfo() retourne un utilisateur si celui-ci existe et que le couple identifiant/mdp existe.
					$idUser = $authModel->isValidLoginInfo($post['email'], $post['password']);
					if($idUser){
						// On appelle la méthode find() qui permet de retourner les résultats en fonction d'un ID
						$user = $usersModel->find($idUser);
						// On vérifie que le compte est activé
						if($user['activation'] == 'true'){
							// La méthode logUserIn() permet de connecter un utilisateur
							$authModel->logUserIn($user);
							// $myUser = $authModel->getLoggedUser(); // Permet de récupérer les infos de sessions
							// $myUser = $this->getUser(); // Permet de récupérer les infos de sessions
							$this->redirectToRoute('default_home');
						}
						else{
							$errors[] = 'Votre compte n\'est pas activé.';
						}
					}
					else{
						$errors[] = 'Le couple identifiant/mot de passe est invalide';
					}
				}
			}
			$params = ['errors' => $errors];
			$this->show('user/login', $params);
		}// fin else
	}

	/**
	 * Function permettant de se déconnecté
	 */
	public function logout(){
		// Si il n'est pas conecter on le redirige
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			//non connecté
			$this->redirectToRoute('default_home');
		}else{
			$userLogout = new AuthModel();
			$userLogout->logUserOut();
			$this->redirectToRoute('default_home');
		}
	}

	/**
	 * Fonction permettant de recevoir un nouveau password
	 */
	public function getNewPassword(){

		$error = [];
		$post = [];
		$success = false;
		$showForm = true;

		// Traitement des formulaires
		if(!empty($_POST)) {
		// Nettoyage des données
			foreach($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

		    // Traitement du formulaire du mail
		    if(isset($post['email'])) {


		    	if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {

		    		// Ici on est sur que l'email est au bon format, on peut donc aller la chercher dans la table USER
					$usersModel = new UsersModel();
					$authModel = new AuthModel();
					$token = md5(uniqid());
					$email = $post['email'];
					$userEmail = $usersModel->findEmail($email);

		    		if(!empty($userEmail)) {    // On search une corres avec le mail

	    			$date_create = date('Y-m-d h:i:s');
						$date_exp = date('Y-m-d h:i:s',strtotime('+2 days'));

		    			$data = [
		    				//la clé du tableau correspond au nom de la colone SQL
		    				'email' 		=> $post['email'],
		    				'token' 		=> $token,
		    				'date_create' 	=> $date_create,
		    				'date_exp' 		=> $date_exp,
		    			];

		    			$tokenPasswordModel = new TokensPasswordModel();

		    			if($tokenPasswordModel->insert($data)) {

		                    // we compose a link to send
		                    $magicLink = '<a href="localhost/limonade/public/lostpassword?email='.$post['email'].'&token='.$token.'">Get new password</a>';
		    		       	$mail = new PHPMailer;
							//$mail->SMTPDebug = 3;                               // Enable verbose debug output
							$mail->isSMTP();                                      // Set mailer to use SMTP
							$mail->Host = 'mailtrap.io';					  // Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'f12564c2d967d2';           // SMTP username
							$mail->Password = 'f693c45ea37fa0';                 // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 465;                                    // TCP port to connect to
							
		    	        	$mail->setFrom('limowf3@yopmail.com', 'contact du site'); //expéditeur
		    	        	$mail->addAddress($post['email'], '');  // Add a recipient// Name is optional
		    	        	$mail->addReplyTo('info@example.com', 'Information');// si on l'enlève ça renvoie auto à l'expéditeur

		    	       	 	$mail->isHTML(true);
		    	       	 	// Set email format to HTML

		    	        	$mail->Subject = 'Récupération de votre mot de passe.';
		    	        	$mail->Body    = $magicLink;
		    	        	$mail->AltBody = $magicLink;

		                    if($mail->send()) {
		                        $showForm = false;
		                        $success = true;
		            		} else {
		                		$error[] = 'Erreur lors de l\'envoie du mail, veuillez renouvler l\'opération. Si le problème persiste, contactez l\'administrateur.';
		        			}
		    			}//fin if insert execute
		    		}//if empty emailexist
		            else {
		                $error[] = 'Votre email n\'est pas enregistré!';
		            }
		    	}//fin filter var
				else
				{
				$error[] = 'Votre adresse email est incorrecte';
				}
		    }// fin if EMPTYpost
		}



		$params = ['error' => $error, 'success' => $success, 'showForm' => $showForm];

		$this->show('user/getNewPassword', $params);
	}

	/**
	 * Function Permettant de demander un nouveau password
	 */
	public function lostPassword(){

		$error = [];
		$post = [];
		$showFormPassword = false; // On affiche le 2nd formulaire de mise à jour de notre mdp
		$showConnectButton = false;


		if(isset($_GET['token']) && !empty($_GET['token']) && isset($_GET['email']) && !empty($_GET['email'])){

			// On récupère et nétoie les valeur des GET
			foreach ($_GET as $key => $value) {
				$get[$key] = trim(strip_tags($value));
			}

			$email = $get['email'];
			$token = $get['token'];

			$tokenModel = new TokensPasswordModel();

			// On vérifie que le token et l'email sont bien dans la base de données
  		$tokenExist = $tokenModel->findTokenPassword($email, $token);

  		if(!empty($tokenExist) && ($tokenExist['date_exp'] > date('Y-m-d H:i:s'))) {
  			// Ici le token est valide et n'a pas expiré, on peut donc afficher le formulaire.
				$showFormPassword = true;
			}
			if($tokenExist['date_exp'] < date('Y-m-d H:i:s')){
				$error[] = 'Le lien n\'est plus valide.' ;
			}
		}//fin if post action

		// Traitement du 2nd formulaire concernant la maj du mdp
		if(isset($_POST['action']) && $_POST['action'] == 'updatePassword') {

	    foreach ($_POST as $key => $value) {
        $post[$key] = trim(strip_tags($value));
	    }
      if(strlen($post['new_password']) < 8 || strlen($post['new_password']) > 25 ) { // Nbres de caractères modifiables
				$error[] = 'Votre mot de passe doit contenir entre 8 et 25 caractères';
			}
			if($post['new_password'] != $post['new_password_conf']) {
				$error[] = 'Vos mots de passe doivent correspondre';
			}
			if(count($error) == 0 ) { // Pas d'erreurs, on continue
				// Ici, on peut changer le mot de passe

				// On "Hash" le password
        $authModel = new AuthModel();
				$password = $authModel->hashPassword($post['new_password']);

				// On récupère les info de la table user grace à son adresse mail
				$usersModel = new UsersModel();
				$infoUser = $usersModel->getUserByUsernameOrEmail($post['email']);

				$data = [
					'password' => $password,
				];

				echo '<hr>'.$infoUser['id'];
				if($usersModel->update($data, $infoUser['id'])){
  	        // Suppression du token car le mdp est modifié
						if($tokenModel->delete($tokenExist['id'])){
              $showFormPassword = false;
              $showConnectButton = true;
            }
				}
				else{
					$error[] = 'Erreur lors du changement de mot de passe, si le problème persiste veuillez contacter l\'administrateur.';
				}
			} // fin if count error
    	else{
          $error[] = 'Le token et l\'adresse email ne correspondent pas.';
    	} //fin else
		}
		$params = ['error' => $error, 'showFormPassword' => $showFormPassword, 'showConnectButton' => $showConnectButton];
		$this->show('user/lostPassword', $params);
	}

	/**
	 * Fonction permettant de mettre a jour les donnés de l'utilisateur connecté
	 */
	public function updateUser(){
		// Si il n'est pas conecté on le redirige
		$loggedUser = $this->getUser();

		if(!isset($loggedUser)){
			//connecté
			$this->redirectToRoute('default_home');
		}else{
			$post = [];
			$errors = [];
			$success = false;
			$successimg = false;
			$adress = ''; //adress est visible pour toute la fonction

			//définit si l'utilisateur est connecté
			$user = $this->getUser();
			$id = $user['id'];


			//qd j'insère le fichier depuis mon formulaire ça le place dan assets
			$folder = $_SERVER['DOCUMENT_ROOT'].'/limonade/public/assets/image/';
			$dbLink = '/limonade/public/assets/image';
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
				if (strlen($post['firstname']) < 2 || strlen($post['firstname']) > 12){
					$errors[] = 'Votre prénom doit contenir entre 2 et 12 caractères';
				}
				if (strlen($post['lastname']) < 2 || strlen($post['lastname']) > 13){
					$errors[] = 'Votre nom doit contenir entre 2 et 13 caractères';
				}
				if ($post['password'] != $post['password_confirm']){
					$errors[] = 'Votre mot de passe n\'est pas identique';
				}
				if (strlen($post['username']) < 3 || strlen($post['username']) > 18){
					$errors[] = 'Votre pseudo doit contenir entre 3 et 18 caractères';
				}
				if(count($errors) === 0){
					// Ici il n'y a pas d'erreurs, on peut donc enregistrer en base de données
					$usersModel = new UsersModel();
					$authModel = new AuthModel();

					//on utilise la méthode insert() qui permet d'insérer des données en bases
					$dataUser = [
						//la clé du tableau correspond au nom de la colone SQL
						'id' 		=> $id,
						'username' 	=> $post['username'],
						'firstname' => $post['firstname'],
						'lastname' 	=> $post['lastname'],
						'password' 	=> $authModel->hashPassword($post['password']),
					];
					if(!empty($post['url'])){
						$dataUser = [
							'url' 		=> $post['url'],
						];
					}
					if(!empty($_FILES['avatar'])){
						$dataUser = [
							'avatar' 	=> $adress,
						];
					}
					// on passe le tableau $data à la méthode update() pour enregistrer nos données en base.
					// Et on ajoute le token dans la table token_register
					if($usersModel->update($dataUser, $id)){
						$success = true;
						$authModel->refreshUser();
					}

				}
			}//if empty post
			//mettre en dehors des verif
			# On envoi les erreurs en paramètre à l'aide d'un tableau (array)
			$params = ['errors' => $errors, 'success' => $success, 'successimg' => $successimg, 'adress' => $adress];
			$this->show('user/updateUser', $params);
		}
	}
}
