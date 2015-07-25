<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use AppLib\Form\Form;

class User extends Form {

    public function __construct() {
        parent::__construct('user');

        $this->setAttribute('method', 'post')
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'User\Form\Fieldset\User',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));
    }

}
