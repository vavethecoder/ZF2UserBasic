<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;
use Doctrine\Common\Persistence\ObjectManager;
use AppLib\Form\Form;
use AppLib\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use User\Form\Fieldset\User as UserFieldset;

class Registration extends Form {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('registration');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($objectManager))
                ->setInputFilter(new InputFilter());

        $userFieldset = new UserFieldset($objectManager);
        $userFieldset->setUseAsBaseFieldset(true);

        $this->add($userFieldset);
    }

}
