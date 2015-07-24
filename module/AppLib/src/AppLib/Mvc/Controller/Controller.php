<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AppLib\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Doctrine\ORM\EntityManager;

class Controller extends AbstractActionController {

    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Sets the AuthManager
     *
     * @param AuthManager $authManager
     * @access protected
     * @return PostController
     */
    protected function setAuthManager(AuthenticationService $authManager) {
        $this->authManager = $authManager;
        return $this;
    }

    /**
     * Returns the AuthManager
     *
     * Fetches the AuthManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return AuthManager
     */
    protected function getAuthManager() {
        if (null === $this->authManager) {
            $this->setAuthManager($this->getServiceLocator()->get('Zend\Authentication\AuthenticationService'));
        }
        return $this->authManager;
    }

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $entityManager
     * @access protected
     * @return PostController
     */
    protected function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        return $this;
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
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }

}
