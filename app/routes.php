<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/event/[:id]', 'Event#showEvent', 'event_showEvent'],
		// ['GET|POST', '/list', 'List#showList', 'list_showList'],
		['GET|POST', '/register', 'User#register', 'user_register'],
	);
