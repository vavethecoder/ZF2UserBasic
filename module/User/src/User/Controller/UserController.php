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
use Application\Entity\User as UserEntity;
use Application\Entity\UserProfile as UserProfileEntity;
use User\Form\User as UserForm;
use User\Form\Registration as UserRegistrationForm;

class UserController extends Controller {

    public function loginAction() {
        $userForm = new UserForm();
        $userForm->get('submit')->setValue('Sign In');
        $userForm->setAttribute('action', '/user')->prepare();

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(array(
                'userForm' => $userForm,
            ));
        }

        $userFormData = $request->getPost();
        $userForm->setData($userFormData);

        if (!$userForm->isValid()) {
            return new ViewModel(array(
                'userForm' => $userForm,
            ));
        }

        $authAdapter = $this->getAuthManager()->getAdapter();
        $authAdapter->setIdentityValue($userFormData['user']['email']);
        $authAdapter->setCredentialValue($userFormData['user']['password']);
        $this->getAuthManager()->authenticate();

        if (!$this->identity()) {
            $this->flashmessenger()->addMessage('Invalid credential.');
        }

        return new ViewModel(array(
            'userForm' => $userForm,
            'messages' => $this->flashmessenger()->getMessages(),
        ));
    }

    public function registrationAction() {
        $userRegForm = new UserRegistrationForm($this->getEntityManager());
        $userRegForm->getInputFilter()->remove('roles');
        $userRegForm->get('submit')->setValue('Sign Up');
        $userRegForm->setAttribute('action', '/user/registration')->prepare();

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(array(
                'userRegForm' => $userRegForm,
            ));
        }

        $userFormData = $request->getPost();
        $userRegForm->setData($userFormData);

        if (!$userRegForm->isValid()) {
            return new ViewModel(array(
                'userRegForm' => $userRegForm,
            ));
        }
        
        $entityManager = $this->getEntityManager();
        
        $email = $entityManager->getRepository('Application\Entity\User')->findOneByEmail($userFormData['user']['email']);
        
        if(!empty($email)) {
            $this->flashmessenger()->addMessage('Email already exist.');
            
            return new ViewModel(array(
                'userRegForm' => $userRegForm,
                'messages' => $this->flashmessenger()->getMessages(),
            ));
        }

        $userEntity = new UserEntity;
        $userEntity->setEmail($userFormData['user']['email']);
        $userEntity->setPassword($userFormData['user']['password']);
        $userEntity->setCreatedAt();
        $userEntity->setUpdatedAt();
        $userEntity->addRole($entityManager->getRepository('Application\Entity\Role')->findOneById($userFormData['roles']['roles']));        
        $entityManager->persist($userEntity);
        $entityManager->flush();

        $userProfileEntity = new UserProfileEntity;
        $userProfileEntity->setFirstName($userFormData['profile']['firstname']);
        $userProfileEntity->setLastName($userFormData['profile']['lastname']);
        $userProfileEntity->setPhone($userFormData['profile']['phone']);
        $userProfileEntity->setWebsite($userFormData['profile']['website']);
        $userProfileEntity->setBirthdate(new \DateTime($userFormData['profile']['birthdate']));
        $userProfileEntity->setUser($userEntity);
        $userProfileEntity->setCreatedAt();
        $userProfileEntity->setUpdatedAt();
        $entityManager->persist($userProfileEntity);
        
        $entityManager->flush();
        $entityManager->clear();
        

        return new ViewModel(array(
            'userRegForm' => $userRegForm,
            'messages' => $this->flashmessenger()->getMessages(),
        ));
    }

}
