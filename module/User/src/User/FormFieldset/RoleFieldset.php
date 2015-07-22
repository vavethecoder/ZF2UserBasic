<?php

namespace User\FormFieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Entity\Role;

class RoleFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('role');

        $this->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new Role());

        $this->add(array(
            'name' => 'role-id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'role',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Role',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'role-select',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Role',
                //'object_manager' => $this->getE,
                'target_class' => 'Application\Entity\Role',
                'property' => 'role',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'getRole',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'role' => array(
                'required' => TRUE,
            ),
            'description' => array(
                'required' => FALSE,
            ),
        );
    }

}
