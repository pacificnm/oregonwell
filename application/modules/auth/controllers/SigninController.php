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
 * @version    $Id: SigninController.php 1.0  Jaimie Garner $
 */
class Auth_SigninController extends Auth_Model_Controller
{

    /**
     * (non-PHPdoc)
     * 
     * @see Application_Model_Base::init()
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
        $form = $this->getSigninForm();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                if ($this->getAuthModel()->process($this->getAllParams())) {
                    
                    $user = $this->getAuthModel()->findByUsername(
                            $this->getParam('username'));
                    
                    $this->setFlashSuccess('Welcome Back ' . $user->name . '!');
                    
                    $identity = Zend_Auth::getInstance()->getIdentity();
                   
                    $from = $this->getParam("from", "/index");
                    
                    $this->redirect($from);
                    
                    
                } else {
                    $this->setFlashError(
                            'The username or password you entered is incorrect.');
                    $this->redirect('/auth/signin');
                }
            }
        }
        $this->view->form = $form;
    }
}