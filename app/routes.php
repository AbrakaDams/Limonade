<?php

	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/event/[:id]', 'Event#showEvent', 'event_showEvent'],
	);
