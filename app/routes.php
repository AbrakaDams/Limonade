<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/contact', 'Default#contact', 'default_contact'],

		/**************************** event ********************/
		['GET|POST', '/event/[i:id]', 'Event#showEvent', 'event_showEvent'],
		['GET|POST', '/create', 'Event#createEvent', 'event_createEvent'],
		['GET', '/search', 'Event#search', 'event_search'],

		['GET', '/get-list', 'List#getList', 'list_getList'],
		['GET|POST', '/add-list', 'List#addList', 'list_addList'],

		/***************************** users *************************/
		['GET|POST', '/register', 'User#register', 'user_register'],
		['GET|POST', '/registerConfirm', 'User#registerConfirm', 'user_registerConfirm'],
		['GET|POST', '/login', 'User#login', 'user_login'],
		['GET|POST', '/logout', 'User#logout', 'user_logout'],
		['GET|POST', '/lostpassword', 'User#lostPassword', 'user_lostPassword'],
		['GET|POST', '/getnewpassword', 'User#getNewPassword', 'user_getNewPassword'],
		['GET|POST', '/updateUser', 'Update#updateUser', 'update_updateUser'],


	);
