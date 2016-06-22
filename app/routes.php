<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/contact', 'Default#contact', 'default_contact'],

		/**************************** event ********************/
		['GET|POST', '/event/[:id]', 'Event#showEvent', 'event_showEvent'],

		/***************************** users *************************/
		['GET|POST', '/register', 'User#register', 'user_register'],
		['GET|POST', '/login', 'User#login', 'user_login'],


	);
