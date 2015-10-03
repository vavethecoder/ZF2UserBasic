<?php

namespace AppLib\Stdlib\Hydrator;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class DoctrineObject extends DoctrineObject {

    /**
     * Set the custom naming strategy and prepare the hydrator by adding strategies to every collection valued associations 
     *
     * @param  object $object
     * @return void
     */
    protected function prepare($object) {
        if (!$this->hasNamingStrategy()) {
            $this->setNamingStrategy(new DoctrineNamingStrategy());
        }
        $this->metadata = $this->objectManager->getClassMetadata(get_class($object));
        $this->prepareStrategies();
    }

}
