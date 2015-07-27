<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use AppLib\Form\Form;
use User\Form\Fieldset\User as UserFieldset;
use User\Form\Fieldset\Role as RoleFieldset;
use User\Form\Fieldset\UserProfile as UserProfileFieldset;

class Registration extends Form {

    public function __construct($entityManager) {
        parent::__construct('registration');

        $this->setAttribute('method', 'post')
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new InputFilter());

        $userFieldset = new UserFieldset();
        $roleFieldset = new RoleFieldset($entityManager);
        $userProfileFieldset = new UserProfileFieldset();

        $this->add($userFieldset, array(
             'options' => array(
                 'use_as_base_fieldset' => true,
             ),
         ));
        $this->add($roleFieldset);
        $this->add($userProfileFieldset);
    }

}
