<?php

$upValid = true;
// création d'une data_base Lemonade si elle n'existe pas.
$db = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
$db->query("create database if not exists lemonade");
$db->query("use lemonade");

/********************************************TABLE USERS ************************************************/

// crée la talbe users si elle n'existe pas.
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `users` (
		`id` INT NOT NULL AUTO_INCREMENT ,
		`username` VARCHAR(255) NOT NULL ,
		`firstname` VARCHAR(255) NOT NULL ,
		`lastname` VARCHAR(255) NOT NULL ,
		`email` VARCHAR(255) NOT NULL ,
		`password` VARCHAR(255) NOT NULL ,
		`role` ENUM('user','admin') NOT NULL ,
		`avatar` VARCHAR(255) NOT NULL,
		`url` VARCHAR(255) NOT NULL,
		`activation` ENUM('true','false') NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE (`email`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}


$password = password_hash( 'limonade', PASSWORD_DEFAULT);

$users = array(
	[
		'username'  	=> 'admin',
		'firstname' 	=> 'Captain',
		'lastname'  	=> 'Obvious',
		'role' 			=> 'admin',
		'email' 		=> 'admin@gmail.com',
		'password' 		=>  $password,
		'avatar' 		=>  'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url'			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
	],
	[
		'username' 		=> 'user',
		'firstname' 	=> 'Not',
		'lastname'  	=> 'Obvious',
		'role' 			=> 'user',
		'email' 		=> 'user@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
	]
);


foreach ($users as $user) {

	$reqEmail = $db->prepare('SELECT email FROM users WHERE email = :email');
	$reqEmail->bindValue(':email', $user['email']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO users (username ,firstname, lastname, role, email, password, avatar, url, activation) VALUES (:username ,:firstname, :lastname, :role, :email, :password, :avatar, :url, :activation)');
		$sql->bindValue(':username', $user['username']);
		$sql->bindValue(':firstname', $user['firstname']);
		$sql->bindValue(':lastname', $user['lastname']);
		$sql->bindValue(':role', $user['role']);
		$sql->bindValue(':email', $user['email']);
		$sql->bindValue(':password', $user['password']);
		$sql->bindValue(':avatar', $user['avatar']);
		$sql->bindValue(':url', $user['url']);
		$sql->bindValue(':activation', $user['activation']);


		$sql->execute();
	}else{
		$upValid = false;
	}
}

/**************************************END TABLE USERS**********************************/

/**************************************TABLE TOKENS PASSWORD**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `tokens_password` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `token` VARCHAR(255) NOT NULL ,
  `date_create` DATETIME NOT NULL,
  `date_exp` DATETIME NOT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE TOKENS PASSWORD**********************************/

/**************************************TABLE TOKENS REGISTER**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `tokens_register` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `token` VARCHAR(255) NOT NULL ,
  `date_create` DATETIME NOT NULL,
  `date_exp` DATETIME NOT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE TOKENS REGISTER**********************************/

/**************************************TABLE COOKIES**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `cookie` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `token_remember` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE COOKIES**********************************/

/************************************** TABLE EVENT**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `event` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`category` ENUM('soiree','vacances','repas','journee') NOT NULL ,
	`title` VARCHAR(255) NOT NULL ,
	`description` TEXT NOT NULL ,
	`address` VARCHAR(255) NOT NULL ,
	`date_start` DATETIME NOT NULL ,
	`date_end` DATETIME NOT NULL ,
	`role` ENUM('public','private') NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}


$events = array(
	[
	  'category'  => 'soiree',
	  'title'  => 'La soirée du siècle !',
	  'description'  => 'Une superbe fête sans musique, sans bouffe, ni boissons, mais beaucoup de prostitués, on va rigoler venez nombreux...',
	  'address'  => 'Pas loin de chez moi... au bout à droite',
	  'date_start'  => '2017-11-11 23:25:06',
	  'date_end'  => '2017-11-12 01:25:06',
	  'role'  => 'public',
	],
  [
    'category'  => 'vacance',
    'title'  => 'Les vacances du siècle !',
    'description'  => 'Un super séjour avec musique, avec bouffe, boissons alcoolisées,  une bonne ambiance de prévue, benez nombreux et nombreuses ;)...',
    'address'  => 'Pas loin de chez moi... au bout a gauche, au fond du couloir',
    'date_start'  => '2017-09-21 08:45:06',
    'date_end'  => '2017-09-21 10:45:06',
    'role'  => 'private',
  ],
  [
    'category'  => 'repas',
    'title'  => 'Le barbeuk de DamDam !',
    'description'  => 'Un délicieux repas de brochettes de tyrannosaure, de ventrêche, de côtes d\'agneaux et de l\'alcool ',
    'address'  => 'Chez moi, sur la terrasse',
    'date_start'  => '2018-05-01 21:12:06',
    'date_end'  => '2018-05-01 22:12:06',
    'role'  => 'public',
  ],
  [
    'category'  => 'journee',
    'title'  => 'Journée travail',
    'description'  => 'une journée de merde comme d\'hab, un lundi habituel',
    'address'  => 'tu vois la route de l\'enfer bin tu la prend c\'est juste au bout',
    'date_start'  => '2017-12-01 12:12:06',
    'date_end'  => '2017-12-01 15:00:06',
    'role'  => 'private',
  ],
  [
    'category'  => 'journee',
    'title'  => 'Journée glandouille',
    'description'  => 'une journée de chill au soleil, à la plage, jeux de sociétés et activités sportives et bières de prévus',
    'address'  => 'Lacanau Bitch',
    'date_start'  => '2017-10-06 01:12:06',
    'date_end'  => '2017-10-06 08:12:06',
    'role'  => 'private',
  ],
);


foreach ($events as $event) {

	$reqTitle = $db->prepare('SELECT title FROM event WHERE title = :title');
	$reqTitle->bindValue(':title', $event['title']);
	$reqTitle->execute();

	if($reqTitle->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO event (category, title, description, address, date_start, date_end, role) VALUES (:category, :title, :description, :address, :date_start, :date_end, :role)');
    $sql->bindValue(':category', $event['category']);
    $sql->bindValue(':title', $event['title']);
    $sql->bindValue(':description', $event['description']);
    $sql->bindValue(':address', $event['address']);
    $sql->bindValue(':date_start', $event['date_start'], PDO::PARAM_INT);
    $sql->bindValue(':date_end', $event['date_end'], PDO::PARAM_INT);
    $sql->bindValue(':role', $event['role']);
		$sql->execute();
	}else{
		$upValid = false;
	}
}

/**************************************END TABLE EVENT**********************************/

/************************************** TABLE event_users**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `event_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `role` ENUM('event_user','event_admin') NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE event_users**********************************/

/************************************** TABLE LIST**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `list` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `id_event` INT NOT NULL ,
  `date_add` DATETIME NOT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE LIST**********************************/

/************************************** TABLE CARDS**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `cards` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  `quantity` INT NOT NULL ,
  `price` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `id_list` INT NOT NULL ,
  `id_event` INT NOT NULL ,
  `date_add` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE CARDS**********************************/

/************************************** TABLE COMMENT**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `content` VARCHAR(255) NOT NULL ,
  `date_add` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE COMMENT**********************************/

/**************************************TABLE NEWSFEED**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `newsfeed` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `action` ENUM('add','remove','comment','assigne','create') NOT NULL ,
  `id_card` INT NOT NULL ,
  `id_comment` INT NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE NEWSFEED**********************************/


/**************************************TABLE CONTACT**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `contact` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) NOT NULL ,
	`email` VARCHAR(255) NOT NULL ,
	`object` VARCHAR(255) NOT NULL ,
	`content` VARCHAR(255) NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/**************************************END TABLE CONTACT**********************************/

/**************************************TABLE OURACCOUNT**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `count` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`personn` VARCHAR(255) NOT NULL ,
	`purchase` VARCHAR(255) NOT NULL ,
	`quantity` INT NOT NULL ,
	`price` FLOAT NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

/************************************END TABLE OURACCOUNT *********************************/




if($upValid){
	echo '<br><br><center><p style="font-size: 20px;"<strong>Base de données bien mise a jour</strong></p></center><br>';
	echo '<center><img src="https://media.giphy.com/media/iwVHUKnyvZKEg/giphy.gif"></center>';
	echo '<br><center><p style="font-size: 20px;"<strong><a href="http://'.$_SERVER['HTTP_HOST'].'/limonade/public/">Cliquer pour continuer vers le site</a></strong></p></center><br><br>';
}else{
	echo '<br><br><center><p style="font-size: 20px;"<strong>Arrete de recharger la page clique plutot sur ce lien</strong></p></center><br>';
	echo '<center><img src="https://media.giphy.com/media/3t7RAFhu75Wwg/giphy.gif"></center>';
	echo '<br><center><p style="font-size: 20px;"<strong><a href="http://'.$_SERVER['HTTP_HOST'].'/limonade/public/">Cliquer pour continuer vers le site</a></strong></p></center><br><br>';
}
