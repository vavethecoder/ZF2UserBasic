<?php

namespace AppLib\Form;

use Zend\Form\Fieldset as ZendFieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\ORM\EntityManager;

class Fieldset extends ZendFieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	
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

    /**
     * @return array
     */
    public function getInputFilterSpecification() {
        return array();
    }

}
