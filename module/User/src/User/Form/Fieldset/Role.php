<?php

namespace User\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\Role as RoleEntity;
use AppLib\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Role extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('role');

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
