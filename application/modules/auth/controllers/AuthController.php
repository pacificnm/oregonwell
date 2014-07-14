<?php

/**
 * MyFlix
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pacificnm.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to pacificnm@gmail.com so we can send you a copy immediately.
 *
 * @category   Auth
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: AuthController.php 1.0  Jaimie Garner $
 */
class Auth_AuthController extends Auth_Model_Controller
{

    /**
     * (non-PHPdoc)
     * 
     * @see PNM_Controller_Action::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Index Action
     */
    public function indexAction ()
    {
        $this->view->auths = $this->getAuthModel()->findAll();
    }

    /**
     * View Action
     */
    public function viewAction ()
    {}

    /**
     * Create Action
     */
    public function createAction ()
    {
        $form = $this->getCreateForm()->auth();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $username = $this->getParam('username');
                $email = $this->getParam('email');
                $password = $this->getCryptModel()->crypt(
                        $this->getParam('password'));
                $name = $this->getParam('name');
                $aclRoleId = $this->getParam('acl_role_id');
                
                $authId = $this->getAuthModel()->save($username, $email, 
                        $password, $name, $aclRoleId);
                
                $this->setFlashSuccess('The Account was created.');
                
                $this->redirect('/auth/index');
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Update Action
     */
    public function updateAction ()
    {}

    /**
     * Delete Action
     */
    public function deleteAction ()
    {}

    /**
     * Signin Action
     */
    public function signinAction ()
    {
        $FormModel = new Application_Form_Auth();
        $AuthModel = new Application_Model_Auth();
        
        $form = $FormModel->signin();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                if ($AuthModel->process($this->getAllParams())) {
                    $auth = Zend_Auth::getInstance();
                    $identity = $auth->getIdentity();
                    
                    $user = $AuthModel->findByUsername(
                            $this->getParam('username'));
                    
                    $this->setFlashSuccess('Welcome Back ' . $user->name . '!');
                    $this->redirect('/index');
                } else {
                    $this->setFlashError(
                            'The username or password you entered is incorrect.');
                    $this->redirect('/auth/signin');
                }
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Singout Action
     */
    public function signoutAction ()
    {
        Zend_Auth::getInstance()->clearIdentity();
        
        $this->_getFlashMessenger()
            ->setNamespace('info')
            ->addMessage('You have been signed out.');
        
        $this->redirect('/index');
    }
}