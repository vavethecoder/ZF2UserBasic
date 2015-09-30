<?php

namespace User\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\UserProfile as UserProfileEntity;
use AppLib\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class UserProfile extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager = NULL) {
        parent::__construct('user-profile');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new UserProfileEntity());

        $this->add(array(
            'name' => 'user-profile-id',            
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'user-id',            
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'first-name',            
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'First Name',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'First Name',
            ),
        ));

        $this->add(array(
            'name' => 'last-name',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Last Name',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Last Name',
            ),
        ));

        $this->add(array(
            'name' => 'birthdate',
            'type' => 'Zend\Form\Element\Date',
            'options' => array(
                'label' => 'Date of Birth',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Date Of Birth',
            ),
        ));

        $this->add(array(
            'name' => 'phone',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Phone No',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Phone Number',
            ),
        ));

        $this->add(array(
            'name' => 'website',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Website',
            ),
            'attributes' => array(
                'class' => 'form-control input-lg',
                'placeholder' => 'Website',
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'firstname' => array(
                'required' => TRUE,
            ),
            'lastname' => array(
                'required' => TRUE,
            ),
            'birthdate' => array(
                'required' => TRUE,
            ),
            'phone' => array(
                'required' => TRUE,
            ),
            'website' => array(
                'required' => FALSE,
            ),
        );
    }

}
