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
 * @version    $Id: UpdateController.php 1.0  Jaimie Garner $
 */
class Auth_UpdateController extends Auth_Model_Controller
{
    /**
     * (non-PHPdoc)
     * @see Application_Model_Base::init()
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Index Action
     */
    public function indexAction()
    {
        $auth = Zend_Auth::getInstance()->getIdentity();
        
        
        
        $form = $this->getUpdateForm()->account($auth);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                    ->getPost())) {
                
                $username = $auth->username;
                $email = $this->getParam('email');
                $password = $auth->password;
                $name = $this->getParam('name');
                $aclRoleId = $auth->acl_role_id;
                
                $this->getAuthModel()->save($username, $email, 
                        $password, $name, $aclRoleId, $auth->auth_id);
                
                $this->setFlashSuccess('Your account was updated.');
                
                $this->redirect('/auth/view/index');
            }
        }
        
        $this->view->form = $form;
    }
    
    public function passwordAction()
    {
        $auth = Zend_Auth::getInstance()->getIdentity();
        
        $form = $this->getUpdateForm()->password();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                    ->getPost())) {
                
                $username = $auth->username;
                $email = $auth->email;
                $password = $this->getCryptModel()->crypt($this->getParam('password'));
                $name = $auth->name;
                $aclRoleId = $auth->acl_role_id;
                
                $this->getAuthModel()->save($username, $email,
                        $password, $name, $aclRoleId, $auth->auth_id);
                
                $this->setFlashSuccess('Your password was changed. You must sign out in order for the new password to take affect.');
                
                $this->redirect('/auth/view/index');
            }
        }
        
        $this->view->form = $form;
    }
}