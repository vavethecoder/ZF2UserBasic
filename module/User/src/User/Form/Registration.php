<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use AppLib\Form\Form;
use User\Form\Fieldset\User as UserFieldset;
use User\Form\Fieldset\Role as RoleFieldset;
use User\Form\Fieldset\UserProfile as UserProfileFieldset;

class Registration extends Form {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('registration');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($objectManager))
                ->setInputFilter(new InputFilter());

        $userFieldset = new UserFieldset($objectManager);
        $userFieldset->setUseAsBaseFieldset(true);
        
        $roleFieldset = new RoleFieldset($objectManager);
        $roleFieldset->setUseAsBaseFieldset(true);
        
        $userProfileFieldset = new UserProfileFieldset($objectManager);
        $userProfileFieldset->setUseAsBaseFieldset(true);

        $this->add($userFieldset);
        $this->add($roleFieldset);
        $this->add($userProfileFieldset);
    }

}
