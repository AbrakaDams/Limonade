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
		['GET|POST', '/listUsers', 'Event#listUsers', 'event_listUsers'],

		/**************************** ourAccount ********************/
		['GET|POST', '/ourAccounts', 'Count#ourAccounts', 'count_ourAccounts'],

		['GET|POST', '/ajax/get-list', 'List#getList', 'list_getList'],
		['GET|POST', '/ajax/add-list', 'List#addList', 'list_addList'],
		['GET|POST', '/ajax/add-card', 'List#addCard', 'list_addCard'],
		['GET|POST', '/ajax/add-comment', 'Comment#insertComment', 'comment_insertComment'],
		['GET|POST', '/ajax/show-comment', 'Comment#showComments', 'comment_showComments'],

		/***************************** users *************************/
		['GET|POST', '/register', 'User#register', 'user_register'],
		['GET|POST', '/registerConfirm', 'User#registerConfirm', 'user_registerConfirm'],
		['GET|POST', '/login', 'User#login', 'user_login'],
		['GET|POST', '/logout', 'User#logout', 'user_logout'],
		['GET|POST', '/lostpassword', 'User#lostPassword', 'user_lostPassword'],
		['GET|POST', '/getnewpassword', 'User#getNewPassword', 'user_getNewPassword'],
		['GET|POST', '/updateUser', 'User#updateUser', 'user_updateUser'],

		/***************************** admin *************************/
		['GET|POST', '/back_office', 'Admin#admin', 'admin_admin'],


	);
