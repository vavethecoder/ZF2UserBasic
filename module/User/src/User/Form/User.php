<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use Application\Form\MainForm;

class User extends MainForm {

    public function __construct() {
        parent::__construct('user');

        $this->setAttribute('method', 'post')
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'User\FormFieldset\UserFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));
    }

}
