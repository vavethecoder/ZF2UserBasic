<?php

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Application\Entity\User as UserEntity;

class User extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('user');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new UserEntity());

        $this->add(array(
            'name' => 'user-id',            
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'email',            
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Password',
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'email' => array(
                'required' => TRUE,
            ),
            'password' => array(
                'required' => TRUE,
            ),
        );
    }

}
