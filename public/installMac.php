<?php

$upValid = true;
// création d'une data_base Lemonade si elle n'existe pas.
$db = new PDO('mysql:host=localhost;charset=utf8', 'root', 'root');
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
		`status` ENUM('default','banned') NOT NULL,
		`id_facebook` BIGINT(11) NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE (`email`, `username`)) ENGINE = InnoDB;"
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
		'status'	=> 'default',
		'id_facebook'	=> '',
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
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'Taileaux',
		'firstname' 	=> 'Michel',
		'lastname'  	=> 'Telo',
		'role' 			=> 'user',
		'email' 		=> 'Michel.telo@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'Swaglordidu13',
		'firstname' 	=> 'Kevin',
		'lastname'  	=> 'De Lacastagne',
		'role' 			=> 'user',
		'email' 		=> 'SwagSISI@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'Patator',
		'firstname' 	=> 'Jean',
		'lastname'  	=> 'Lucas',
		'role' 			=> 'user',
		'email' 		=> 'j.lucas@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'lila33',
		'firstname' 	=> 'Lucie',
		'lastname'  	=> 'Canaillou',
		'role' 			=> 'user',
		'email' 		=> 'Lucie.C@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'true',
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'babar27',
		'firstname' 	=> 'Quentin',
		'lastname'  	=> 'Blanchard',
		'role' 			=> 'user',
		'email' 		=> 'babar27@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'false',
		'status'	=> 'default',
		'id_facebook'	=> '',
	],
	[
		'username' 		=> 'Coca Cola',
		'firstname' 	=> 'Pepsi',
		'lastname'  	=> 'Entertaiment',
		'role' 			=> 'user',
		'email' 		=> 'Capitaliste@gmail.com',
		'password' 		=>	$password,
		'avatar' 		=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'url' 			=> 'https://www.vidbooster.com/wp-content/uploads/2016/04/avatar.jpg',
		'activation'	=> 'false',
		'status'		=> 'default',
		'id_facebook'	=> '',
	],
);


foreach ($users as $user) {

	$reqEmail = $db->prepare('SELECT email FROM users WHERE email = :email');
	$reqEmail->bindValue(':email', $user['email']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO users (username ,firstname, lastname, role, email, password, avatar, url, activation, status) VALUES (:username ,:firstname, :lastname, :role, :email, :password, :avatar, :url, :activation, :status)');
		$sql->bindValue(':username', 	$user['username']);
		$sql->bindValue(':firstname', 	$user['firstname']);
		$sql->bindValue(':lastname', 	$user['lastname']);
		$sql->bindValue(':role', 		$user['role']);
		$sql->bindValue(':email', 		$user['email']);
		$sql->bindValue(':password', 	$user['password']);
		$sql->bindValue(':avatar', 		$user['avatar']);
		$sql->bindValue(':url', 		$user['url']);
		$sql->bindValue(':activation', 	$user['activation']);
		$sql->bindValue(':status', 		$user['status']);


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

$tokens_password = array(
	[
		'email' 		=> 'admin@gmail.com',
		'token' 		=> '',
		'date_create' 	=> '2016-06-30 08:00:00',
		'date_exp' 		=> '2016-07-01 08:00:00'
	],
	[
		'email' 		=> 'user@gmail.com',
		'token' 		=> '',
		'date_create' 	=> '2016-06-30 08:00:00',
		'date_exp' 		=> '2016-07-01 08:00:00'
	]
);

foreach ($tokens_password as $token_password) {

	$reqEmail = $db->prepare('SELECT email FROM tokens_password WHERE email = :email');
	$reqEmail->bindValue(':email', $token_password['email']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO tokens_password (email, token, date_create, date_exp) VALUES (:email, :token, :date_create, :date_exp)');
		$sql->bindValue(':email', 		$token_password['email']);
		$sql->bindValue(':token',		$token_password['token']);
		$sql->bindValue(':date_create', $token_password['date_create']);
		$sql->bindValue(':date_exp', 	$token_password['date_exp']);

		$sql->execute();
	}else{
		$upValid = false;
	}
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

$tokens_register = array(
	[
		'email' 		=> 'babar27@gmail.com',
		'token' 		=> '',
		'date_create' 	=> '2016-06-30 08:00:00',
		'date_exp' 		=> '2016-07-01 08:00:00'
	],
	[
		'email' 		=> 'Capitaliste@gmail.com',
		'token' 		=> '',
		'date_create' 	=> '2016-06-30 08:00:00',
		'date_exp' 		=> '2016-07-01 08:00:00'
	]
);

foreach ($tokens_register as $token_register) {

	$reqEmail = $db->prepare('SELECT email FROM tokens_register WHERE email = :email');
	$reqEmail->bindValue(':email', $token_register['email']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO tokens_register (email, token, date_create, date_exp) VALUES (:email, :token, :date_create, :date_exp)');
		$sql->bindValue(':email', 		$token_register['email']);
		$sql->bindValue(':token',		$token_register['token']);
		$sql->bindValue(':date_create', $token_register['date_create']);
		$sql->bindValue(':date_exp', 	$token_register['date_exp']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}

/**************************************END TABLE TOKENS REGISTER**********************************/
/**************************************TABLE NOTIFICATIONS ****************************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_user` INT NOT NULL ,
  `id_event` INT NOT NULL ,
  `content` VARCHAR(255) NOT NULL ,
  `date_create` DATETIME NOT NULL,
  `is_read` ENUM('unread','read') NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$notifications = array(
	[
		'id_user' 		=> '1',
		'id_event' 		=> '1',
		'content' 		=> 'Vous avez été invité à l\'évènement : La soirée du siècle !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 			=> 'unread',
	],
	[
		'id_user' 		=> '1',
		'id_event' 		=> '2',
		'content' 		=> 'Vous avez été invité à l\'évènement : Les vacances du siècle !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 			=> 'unread',
	],
	[
		'id_user' 		=> '1',
		'id_event' 		=> '3',
		'content' 		=> 'Vous avez été invité à l\'évènement : Le barbeuk de DamDam !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 			=> 'unread',
	],
	[
		'id_user' 		=> '4',
		'id_event' 		=> '3',
		'content' 		=> 'Vous avez été invité à l\'évènement : Le barbeuk de DamDam !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 			=> 'unread',
	],
	[
		'id_user' 		=> '3',
		'id_event' 		=> '3',
		'content' 		=> 'Vous avez été invité à l\'évènement : Le barbeuk de DamDam !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 			=> 'unread'
	],
	[
		'id_user' 		=> '2',
		'id_event' 		=> '2',
		'content' 		=> 'Vous avez été invité à l\'évènement : Les vacances du siècle !',
		'date_create' 	=> '2016-06-28 08:00:00',
		'is_read' 		=> 'unread',
	],
);
foreach ($notifications as $notification) {

	$reqExist = $db->prepare('SELECT * FROM notifications WHERE id_user = :id_user AND id_event = :id_event');
	$reqExist->bindValue(':id_user', $notification['id_user'], PDO::PARAM_INT);
	$reqExist->bindValue(':id_event', $notification['id_event'], PDO::PARAM_INT);
	$reqExist->execute();

	if($reqExist->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO notifications (id_user, id_event, content, date_create, is_read) VALUES (:id_user, :id_event, :content, :date_create, :is_read)');
		$sql->bindValue(':id_user', 		$notification['id_user'], PDO::PARAM_INT);
		$sql->bindValue(':id_event',		$notification['id_event'], PDO::PARAM_INT);
		$sql->bindValue(':content', 		$notification['content']);
		$sql->bindValue(':date_create', 	$notification['date_create']);
		$sql->bindValue(':is_read', 		$notification['is_read']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}


/**************************************END TABLE NOTIFICATION*************************************/

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
	`event_avatar` VARCHAR(255) NOT NULL ,
	`event_cover` VARCHAR(255) NOT NULL ,
	`role` ENUM('public','private') NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}


$events = array(
	[
	  'category'  => 'soiree',
	  'title'  => 'Gotham Night!',
	  'description'  => 'Une grande soirée déguisée sur le thème de l\'univers de Batman, venez nombreux !',
	  'address'  => 'Au manoir Wayne ',
	  'date_start'  => '2017-11-11 23:25:06',
	  'date_end'  => '2017-11-12 01:25:06',
	  'event_avatar'  => '',
	  'role'  => 'public',
	],
	[
    'category'  => 'journee',
    'title'  => 'Jeux de sociétés et activités extérieures',
    'description'  => 'Une journée jeux de sociétés, activités sportives et partage de bons moments avec des personnes de votre quartier',
    'address'  => 'Au Jardin Public ',
    'date_start'  => '2017-12-01 13:15:06',
    'date_end'  => '2017-12-01 20:00:00',
    'event_avatar'  => '',
    'role'  => 'public',
  ],
  [
    'category'  => 'vacances',
    'title'  => 'Séjour Camping des flots bleus !',
    'description'  => 'Un super séjour au camping des Flots Bleus avec des activités sportives, des randonnées, une bonne ambiance de prévue, venez nombreux et nombreuses ;)...',
    'address'  => 'Camping des Flots Bleus',
    'date_start'  => '2017-09-21 08:45:06',
    'date_end'  => '2017-09-21 10:45:06',
    'event_avatar'  => '',
    'role'  => 'public',
  ],
  [
    'category'  => 'repas',
    'title'  => 'Le barbeuk de DamDam !',
    'description'  => 'Un délicieux repas de brochettes de tyrannosaure, de ventrêches, de côtes d\'agneaux et de l\'alcool avec Modération',
    'address'  => 'Chez moi, sur la terrasse',
    'date_start'  => '2018-05-01 21:12:06',
    'date_end'  => '2018-05-01 22:12:06',
    'event_avatar'  => '',
    'role'  => 'private',
  ],
  [
    'category'  => 'repas',
    'title'  => 'Repas de quartier',
    'description'  => 'Repas de quartier Caudéran, avec barbecue au parc du Bourran, groupe de musique, vide-grenier et activités de groupe prévu après le repas.',
    'address'  => 'Au Parc du Bourran',
    'date_start'  => '2018-10-06 11:30:00',
    'date_end'  => '2018-10-06 21:30:06',
    'event_avatar'  => '',
    'role'  => 'public',
  ],
  [
    'category'  => 'journee',
    'title'  => 'Journée travail',
    'description'  => 'Une journée de travail banale, un fauteuil inconfortable et du café',
    'address'  => 'Au bureau ',
    'date_start'  => '2017-12-01 12:12:06',
    'date_end'  => '2017-12-01 15:00:06',
    'event_avatar'  => '',
    'role'  => 'public',
  ],
  [
    'category'  => 'journee',
    'title'  => 'Journée plage',
    'description'  => 'Une journée au soleil, à la plage, jeux de sociétés, activités sportives en plein air entre amis pour bien commencer l\'été',
    'address'  => 'Lacanau Beach',
    'date_start'  => '2017-10-06 12:12:06',
    'date_end'  => '2017-10-06 20:12:06',
    'event_avatar'  => '',
    'role'  => 'private',
  ], 
  [
	  'category'  => 'soiree',
	  'title'  => 'Pot de départ de Paul au Japon',
	  'description'  => 'A l\'occassion du départ de Jean au Japon, une soirée de départ est organisée.Ne lui dites rien, la suprise doit être totale !',
	  'address'  => 'Chez le frère de Paul, Jean à Bordeaux',
	  'date_start'  => '2017-11-11 19:30:00',
	  'date_end'  => '2017-12-11 10:25:06',
	  'event_avatar'  => '',
	  'role'  => 'private',
	],
);


foreach ($events as $event) {

	$reqTitle = $db->prepare('SELECT title FROM event WHERE title = :title');
	$reqTitle->bindValue(':title', $event['title']);
	$reqTitle->execute();

	if($reqTitle->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO event (category, title, description, address, date_start, date_end, event_avatar, role) VALUES (:category, :title, :description, :address, :date_start, :date_end, :event_avatar, :role)');
    $sql->bindValue(':category', $event['category']);
    $sql->bindValue(':title', $event['title']);
    $sql->bindValue(':description', $event['description']);
    $sql->bindValue(':address', $event['address']);
    $sql->bindValue(':date_start', $event['date_start'], PDO::PARAM_INT);
    $sql->bindValue(':date_end', $event['date_end'], PDO::PARAM_INT);
	$sql->bindValue(':event_avatar', $event['event_avatar']);
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

$event_users = array(
	[
		'id_user' 	=> '1',
		'id_event' 	=> '1',
		'role'		=> 'event_admin',
	],
	[
		'id_user' 	=> '1',
		'id_event' 	=> '2',
		'role'		=> 'event_admin',
	],
	[
		'id_user' 	=> '1',
		'id_event' 	=> '3',
		'role'		=> 'event_user',
	],
	[
		'id_user' 	=> '4',
		'id_event' 	=> '3',
		'role'		=> 'event_user',
	],
	[
		'id_user' 	=> '3',
		'id_event' 	=> '3',
		'role'		=> 'event_user',
	],
	[
		'id_user' 	=> '2',
		'id_event' 	=> '2',
		'role'		=> 'event_user',
	],
);
foreach ($event_users as $event_user) {

	$reqEmail = $db->prepare('SELECT * FROM event_users WHERE id_user = :id_user AND id_event = :id_event');
	$reqEmail->bindValue(':id_user', $event_user['id_user']);
	$reqEmail->bindValue(':id_event', $event_user['id_event']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO event_users (id_user, id_event, role) VALUES (:id_user, :id_event, :role)');
		$sql->bindValue(':id_user', 		$event_user['id_user']);
		$sql->bindValue(':id_event',		$event_user['id_event']);
		$sql->bindValue(':role', 		$event_user['role']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}


/**************************************END TABLE event_users**********************************/

/************************************** TABLE LIST**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `list` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `list_title` VARCHAR(255) NOT NULL ,
  `id_event` INT NOT NULL ,
  `date_add` DATETIME NOT NULL,
  PRIMARY KEY (`id`) ,
  FOREIGN KEY (id_event) REFERENCES event (id) ON DELETE CASCADE)
  ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$lists = array(
	[
		'list_title' 	=> 'Alcool !!',
		'id_event' 	=> '1',
		'date_add'	=> '2016-06-28 08:00:00',
	],
	[
		'list_title' 	=> 'Gateaux',
		'id_event' 	=> '1',
		'date_add'	=> '2016-06-28 08:00:00',
	],
	[
		'list_title' 	=> 'Hébergement',
		'id_event' 	=> '2',
		'date_add'	=> '2016-06-28 08:00:00',
	],
	[
		'list_title' 	=> 'Transport',
		'id_event' 	=> '2',
		'date_add'	=> '2016-06-28 08:00:00',
	],
	[
		'list_title' 	=> 'Viandes',
		'id_event' 	=> '3',
		'date_add'	=> '2016-06-28 08:00:00',
	],
	[
		'list_title' 	=> 'Boissons',
		'id_event' 	=> '3',
		'date_add'	=> '2016-06-28 08:00:00',
	],
);

foreach ($lists as $list) {

	$reqEmail = $db->prepare('SELECT * FROM list WHERE id_event = :id_event AND list_title = :title');
	$reqEmail->bindValue(':id_event', $list['id_event']);
	$reqEmail->bindValue(':title', $list['list_title']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO list (list_title, id_event, date_add) VALUES (:title, :id_event, :date_add)');
		$sql->bindValue(':title', 		$list['list_title']);
		$sql->bindValue(':id_event',	$list['id_event']);
		$sql->bindValue(':date_add', 	$list['date_add']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}
/**************************************END TABLE LIST**********************************/

/************************************** TABLE CARDS**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `cards` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `card_title` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  `quantity` INT NOT NULL ,
  `price` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `id_list` INT NOT NULL ,
  `id_event` INT NOT NULL ,
  `date_add` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  FOREIGN KEY (id_list) REFERENCES list (id) ON DELETE CASCADE)
  ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$cards = array(
	[
	  'card_title'  => 'Bières',
	  'description'  => 'Des bière à boire avec modération bien sur.',
	  'quantity'  => '30',
	  'price'  => '30',
	  'id_user'  => '6',
	  'id_list'  => '1',
	  'id_event'  => '1',
	  'date_add'  => '2016-06-28 09:00:00',
	],
	[
	  'card_title'  => 'Tarte au citron',
	  'description'  => 'Parce que c\'est les tiennes les meilleurs',
	  'quantity'  => '2',
	  'price'  => '10',
	  'id_user'  => '2',
	  'id_list'  => '2',
	  'id_event'  => '1',
	  'date_add'  => '2016-06-28 09:00:00',
	],
	[
	  'card_title'  => 'Camping',
	  'description'  => 'Faire la réservation du camping, on ne dort pas sous un pont à Arcachon.',
	  'quantity'  => '1',
	  'price'  => '200',
	  'id_user'  => '5',
	  'id_list'  => '3',
	  'id_event'  => '2',
	  'date_add'  => '2016-06-28 09:00:00',
	],
	[
	  'card_title'  => 'Ma petite fiat Panda',
	  'description'  => 'J\'ai 2 places dans ma modeste voiture :)',
	  'quantity'  => '2',
	  'price'  => '5',
	  'id_user'  => '1',
	  'id_list'  => '4',
	  'id_event'  => '2',
	  'date_add'  => '2016-06-28 09:00:00',
	],
	[
	  'card_title'  => 'Saucisses',
	  'description'  => 'De bonnes saucisses pour bien manger',
	  'quantity'  => '50',
	  'price'  => '30',
	  'id_user'  => '4',
	  'id_list'  => '5',
	  'id_event'  => '3',
	  'date_add'  => '2016-06-28 09:00:00',
	],
	[
	  'card_title'  => 'Bières',
	  'description'  => 'Pas de bon barbeuk sans de bonnes bières.',
	  'quantity'  => '100',
	  'price'  => '40',
	  'id_user'  => '3',
	  'id_list'  => '6',
	  'id_event'  => '3',
	  'date_add'  => '2016-06-28 09:00:00',
	],
);

foreach ($cards as $card) {

	$reqEmail = $db->prepare('SELECT * FROM cards WHERE card_title = :title AND id_list = :id_list AND id_event = :id_event ');
	$reqEmail->bindValue(':title', $card['card_title']);
	$reqEmail->bindValue(':id_list', $card['id_list']);
	$reqEmail->bindValue(':id_event', $card['id_event']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO cards (card_title, description, quantity, price, id_user, id_list, id_event, date_add) VALUES (:title, :description, :quantity, :price, :id_user, :id_list, :id_event, :date_add)');
		$sql->bindValue(':title', 		$card['card_title']);
		$sql->bindValue(':description',	$card['description']);
		$sql->bindValue(':quantity', 	$card['quantity']);
		$sql->bindValue(':price', 		$card['price']);
		$sql->bindValue(':id_user', 	$card['id_user']);
		$sql->bindValue(':id_list', 	$card['id_list']);
		$sql->bindValue(':id_event', 	$card['id_event']);
		$sql->bindValue(':date_add', 	$card['date_add']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}
/**************************************END TABLE CARDS**********************************/

/************************************** TABLE COMMENT**********************************/


$sql = $db->exec("CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `content` VARCHAR(255) NOT NULL ,
  `date_add` DATETIME NOT NULL ,
  PRIMARY KEY (`id`),
  FOREIGN KEY (id_event) REFERENCES event (id) ON DELETE CASCADE)
  ENGINE = InnoDB;"
);
if($sql === false){
	die(var_dump($db->errorInfo()));
}

$comments = array(
	[
	  'id_event' 	=> '1',
	  'id_user'  	=> '6',
	  'content'  	=> 'C\'est bon j\'ai les bières',
	  'date_add'  	=> '2016-06-28 14:00:00',
	],
	[
	  'id_event' 	=> '1',
	  'id_user'  	=> '2',
	  'content'  	=> 'Ok c\'est bon pour les gateaux mais qui s\'occupe de la musique ?',
	  'date_add'  	=> '2016-06-28 15:00:00',
	],
	[
	  'id_event' 	=> '2',
	  'id_user'  	=> '5',
	  'content'  	=> 'Ok sa tombe bien je vais à Arcachon ce weekend, je pourrais aller comparer les prix',
	  'date_add'  	=> '2016-06-28 14:00:00',
	],
	[
	  'id_event' 	=> '2',
	  'id_user'  	=> '4',
	  'content'  	=> 'Wesh c nul une Fiat Panda meskin',
	  'date_add'  	=> '2016-06-28 23:58:00',
	],
	[
	  'id_event' 	=> '3',
	  'id_user'  	=> '5',
	  'content'  	=> 'C\'est bon j\'ai les bières',
	  'date_add'  	=> '2016-06-28 14:00:00',
	],
	[
	  'id_event' 	=> '3',
	  'id_user'  	=> '6',
	  'content'  	=> 'Moi aussi !',
	  'date_add'  	=> '2016-06-28 14:10:00',
	],
	[
	  'id_event' 	=> '3',
	  'id_user'  	=> '7',
	  'content'  	=> 'J\'ai des bieres et du rhum',
	  'date_add'  	=> '2016-06-28 15:13:12',
	],[
	  'id_event' 	=> '3',
	  'id_user'  	=> '7',
	  'content'  	=> 'Et il doit me rester un fond de wisky aussi',
	  'date_add'  	=> '2016-06-28 15:13:25',
	],
);
foreach ($comments as $comment) {

	$reqEmail = $db->prepare('SELECT * FROM comments WHERE content = :content AND id_user = :id_user AND id_event = :id_event ');
	$reqEmail->bindValue(':content', 	$comment['content']);
	$reqEmail->bindValue(':id_user', 	$comment['id_user']);
	$reqEmail->bindValue(':id_event', 	$comment['id_event']);
	$reqEmail->execute();

	if($reqEmail->rowCount() == 0){

		$sql = $db->prepare('INSERT INTO comments (id_event, id_user, content, date_add) VALUES (:id_event, :id_user, :content, :date_add)');
		$sql->bindValue(':id_event', 	$comment['id_event']);
		$sql->bindValue(':id_user',		$comment['id_user']);
		$sql->bindValue(':content', 	$comment['content']);
		$sql->bindValue(':date_add', 	$comment['date_add']);

		$sql->execute();
	}else{
		$upValid = false;
	}
}
/**************************************END TABLE COMMENT**********************************/

/**************************************TABLE NEWSFEED**********************************/

$sql = $db->exec("CREATE TABLE IF NOT EXISTS `newsfeed` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_event` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `action` ENUM('add','remove', 'modify') NOT NULL ,
  `id_card` INT NOT NULL ,
  `id_list` INT NOT NULL ,
  `date_news` DATETIME NOT NULL ,
  PRIMARY KEY (`id`),
  FOREIGN KEY (id_event) REFERENCES event (id) ON DELETE CASCADE) ENGINE = InnoDB;"
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
