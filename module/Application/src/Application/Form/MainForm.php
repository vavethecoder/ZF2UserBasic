<?php

namespace Application\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class MainForm extends Form {

    /**
     * @var EntityManager
     */
    private $entityManager;

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

    public function __construct() {
        parent::__construct();

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'class' => 'btn btn-primary btn-lg btn-block',
                'type' => 'submit',
                'value' => 'Submit',
            ),
        ));
    }

}
