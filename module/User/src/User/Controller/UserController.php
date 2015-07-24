<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\View\Model\ViewModel;
use AppLib\Mvc\Controller\Controller;
use User\Form\User as UserForm;
use User\Form\Registration as UserRegistrationForm;
use Application\Entity\User as UserEntity;

class UserController extends Controller {

    public function loginAction() {
        $userForm = new UserForm();
        $userEntity = new UserEntity();
        $userForm->bind($userEntity);
        $userForm->get('submit')->setValue('Sign In');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(array(
                'formUser' => $userForm,
            ));
        }

        $userFormData = $request->getPost();
        $userForm->setData($userFormData);

        if (!$userForm->isValid()) {
            return new ViewModel(array(
                'formUser' => $userForm,
            ));
        }

        $authAdapter = $this->getAuthManager()->getAdapter();
        $authAdapter->setIdentityValue($userFormData['user']['email']);
        $authAdapter->setCredentialValue($userFormData['user']['password']);
        $this->getAuthManager()->authenticate();
        
        if (!$this->identity()) {
            $this->flashmessenger()->addMessage('Invalid credential');
        }

        return new ViewModel(array(
            'formUser' => $userForm,
            'messages'  => $this->flashmessenger()->getMessages(),
        ));
    }

    public function registrationAction() {
        $userRegForm = new UserRegistrationForm();
        $userEntity = new UserEntity();
        $userRegForm->bind($userEntity);
        $userRegForm->get('submit')->setValue('Sign Up');

        return new ViewModel(array(
            'userRegForm' => $userRegForm,
            'messages'  => $this->flashmessenger()->getMessages(),
        ));
    }

}
