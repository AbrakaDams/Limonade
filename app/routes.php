<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/event/[:id]', 'Event#showEvent', 'event_showEvent'],
		['GET|POST', '/register', 'User#register', 'user_register'],
		['GET|POST', '/login', 'User#login', 'user_login'],
		['GET|POST', '/contact', 'Default#contact', 'default_contact'],

	);
