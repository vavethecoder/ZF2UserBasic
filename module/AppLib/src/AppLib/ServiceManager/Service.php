<?php

/**
 * SONIM TECHNOLOGIES INC. PROPRIETARY INFORMATION
 *
 * This Vendor controller does the Update, delete and activate .
 *
 * LICENSE		This software is supplied under the terms of a license agreement or
 * 				nondisclosure agreement with Sonim Technologies Inc. and may not be copied
 * 				or disclosed except in accordance with the terms of that agreement.
 *
 * @category	Service
 * @package		cloud
 * @subpackage	Extra
 * @author		Jiss Thomas <jiss.t@sonimtech.com>
 * @version		SVN: $Id$
 * @copyright	Copyright (c) 2014 - 2015, Sonim Technologies
 * @since		File available since release 1.0.3
 */

namespace AppLib\ServiceManager;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Doctrine\ORM\EntityManager;

class Service implements ServiceLocatorAwareInterface {

	protected $serviceLocator;
	protected $authManager;
	protected $entityManager;

	/**
	 * Sets the ServiceLocatorInterface
	 *
	 * @param AuthenticationService $serviceLocator
	 * @access protected
	 * @return Void
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}

	/**
	 * Returns the ServiceLocatorInterface
	 *
	 * Fetches the ServiceLocator
	 *
	 * @access protected
	 * @return ServiceLocator
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}

	/**
	 * Sets the AuthenticationService
	 *
	 * @param AuthenticationService $authManager
	 * @access protected
	 * @return Void
	 */
	protected function setAuthManager(AuthenticationService $authManager) {
		$this->authManager = $authManager;
	}

	/**
	 * Returns the AuthenticationService
	 *
	 * Fetches the AuthenticationService from ServiceLocator if it has not been initiated
	 * and then returns it
	 *
	 * @access protected
	 * @return AuthenticationService
	 */
	public function getAuthManager() {
		if (!$this->authManager) {
			$this->setAuthManager($this->getServiceLocator()->get('Zend\Authentication\AuthenticationService'));
		}
		return $this->authManager;
	}

	/**
	 * Sets the EntityManager
	 *
	 * @param EntityManager $entityManager
	 * @access protected
	 * @return Void
	 */
	protected function setEntityManager(EntityManager $entityManager) {
		$this->entityManager = $entityManager;
	}

	/**
	 * Returns the EntityManager
	 *
	 * Fetches the EntityManager from ServiceLocator if it has not been initiated
	 * and then returns it
	 *
	 * @access protected
	 * @return EntityManager
	 */
	protected function getEntityManager() {
		if (!$this->entityManager) {
			$this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		return $this->entityManager;
	}

}
