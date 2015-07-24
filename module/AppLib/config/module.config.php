<?php

return array(
	// Invake Controller Plugin
	'controller_plugins' => array(
		'invokables' => array(
			'role' => '\SonimLibrary\Mvc\Controller\Plugin\Role',
		)
	),
	'service_manager' => array(
		'invokables' => array(
			'mail' => 'SonimLibrary\Mail\Mail',
		),
	),
);
