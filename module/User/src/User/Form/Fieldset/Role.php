<?php

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Application\Entity\Role as RoleEntity;

class Role extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('roles');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new RoleEntity());

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
            'name' => 'roles',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Role',
                'object_manager' => $objectManager,
                'target_class' => 'Application\Entity\Role',
                'property' => 'role',
                'display_empty_item' => true,
                'empty_item_label' => 'Select Role',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
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
            'roles' => array(
                'required' => TRUE,
            ),
        );
    }

}
