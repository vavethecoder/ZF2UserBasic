<?php

namespace AppLib\Form;

use Zend\Form\Form;

class Form extends Form {

    public function __construct() {
        parent::__construct();

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'class' => 'btn btn-primary btn-lg btn-block',
                'type' => 'submit',
                'value' => 'Submit',
            ),
        ));
    }

}
