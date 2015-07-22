<?php

namespace User\FormFieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Entity\User;

class UserFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('user');

        $this->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new User());

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
