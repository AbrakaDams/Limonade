<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/team', 'Default#team', 'default_team'],
		['GET|POST', '/contact', 'Contact#contact', 'contact_contact'],

		/**************************** event ********************/
		['GET|POST', '/event/[i:id]', 'Event#showEvent', 'event_showEvent'],
		['GET|POST', '/create', 'Event#createEvent', 'event_createEvent'],
		['GET', '/search', 'Event#search', 'event_search'],
		['GET|POST', '/invite/[i:id]', 'Event#invite', 'event_invite'],


		/**************************** ourAccount ********************/
		['GET|POST', '/ourAccounts', 'Count#ourAccounts', 'count_ourAccounts'],

		/**************************** ajax ****************************/
		['GET|POST', '/ajax/get-list', 'List#getList', 'list_getList'],
		['GET|POST', '/ajax/add-list', 'List#addList', 'list_addList'],
		['GET|POST', '/ajax/add-card', 'List#addCard', 'list_addCard'],
		['GET|POST', '/ajax/add-comment', 'Comment#insertComment', 'comment_insertComment'],
		['GET|POST', '/ajax/show-comment', 'Comment#showComments', 'comment_showComments'],
		['GET|POST', '/ajax/join-comment', 'Comment#joinComment', 'comment_joinComment'],
		['GET|POST', '/ajax/list-users', 'Event#listUsers', 'event_listUsers'],
		['GET|POST', '/ajax/add-participant', 'Event#addParticipant', 'event_addParticipant'],
		['GET|POST', '/ajax/delete-participant/[i:idEvent]/[i:idUser]', 'Event#deleteParticipant', 'event_deleteParticipant'],

		/***************************** users *************************/
		['GET|POST', '/register', 'User#register', 'user_register'],
		['GET|POST', '/registerConfirm', 'User#registerConfirm', 'user_registerConfirm'],
		['GET|POST', '/login', 'User#login', 'user_login'],
		['GET|POST', '/logout', 'User#logout', 'user_logout'],
		['GET|POST', '/lostpassword', 'User#lostPassword', 'user_lostPassword'],
		['GET|POST', '/getnewpassword', 'User#getNewPassword', 'user_getNewPassword'],
		['GET|POST', '/updateUser', 'User#updateUser', 'user_updateUser'],
		
		['GET|POST', '/facebook/auth', 'User#loginFacebook', 'user_loginFacebook'],
		['GET|POST', '/facebook/logged', 'User#fbCallBack', 'user_fbCallBack'],

		/***************************** admin *************************/
		['GET|POST', '/back_office', 'Admin#admin', 'admin_admin'],


	);
