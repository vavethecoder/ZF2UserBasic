<?php

namespace AppLib;

class Module {

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getViewHelperConfig() {
		return array(
			'factories' => array(
				'role' => function ($serviceManager) {
					$roles = $serviceManager->getServiceLocator()->get('config')['roles'];
					$identity = $serviceManager->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();
					$viewHelper = new \SonimLibrary\View\Helper\Role($roles, $identity);
					return $viewHelper;
				}
			),
		);
	}

}
