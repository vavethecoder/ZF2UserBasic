<?php

namespace AppLib;

return array(
    // Invoke Controller Plugin
    'controller_plugins' => array(
        'invokables' => array(
            'role' => '\SonimLibrary\Mvc\Controller\Plugin\Role',
        )
    ),
    // Invoke Service Manager
    'service_manager' => array(
        'invokables' => array(
            'mail' => 'SonimLibrary\Mail\Mail',
        ),
    ),
);
