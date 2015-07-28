<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use AppLib\Form\Form;

class User extends Form {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('user');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($objectManager))
                ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'User\Form\Fieldset\User',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));
    }

}
