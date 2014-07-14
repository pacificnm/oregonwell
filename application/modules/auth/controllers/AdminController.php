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
 * @version    $Id: AdminController.php 1.0  Jaimie Garner $
 */
class Auth_AdminController extends Auth_Model_Controller
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
        $this->view->accounts = $this->getAuthModel()->findAll();
    }

    /**
     * View Action
     */
    public function viewAction ()
    {
        $this->view->account = $this->getAuthModel()->findById(
                $this->getAuthId());
    }

    /**
     * Create Action
     */
    public function createAction ()
    {
        $form = $this->getCreateForm()->admin();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $username = $this->getParam('username');
                $email = $this->getParam('email');
                $password = $this->getCrypt()->crypt($this->getParam('password'));
                $name = $this->getParam('name');
                $aclRoleId = $this->getParam('acl_role_id');
                
                $authId = $this->getAuthModel()->save($username, $email, $password, $name, $authType, $aclRoleId, $userId, $employeeId);
                
                $this->setFlashSuccess('The account was created.');
                
                $this->redirect('/auth/admin/view/auth_id/' . $authId);
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Update Action
     */
    public function updateAction ()
    {
        $account = $this->getAuthModel()->findById($this->getAuthId());
        
        $form = $this->getUpdateForm()->admin($account);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $username = $this->getParam('username');
                $email = $this->getParam('email');
                $password = $account->password;
                $name = $this->getParam('name');
                $aclRoleId = $this->getParam('acl_role_id');
                
                switch($aclRoleId) {
                	
                }
                
                $this->getAuthModel()->save($username, $email, $password, $name, $authType, $aclRoleId, $userId, $employeeId,
            			$this->getAuthId());
                
                $this->setFlashSuccess('The account information was saved');
                
                $this->redirect(
                        '/auth/admin/view/auth_id/' . $this->getAuthId());
            }
        }
        
        $this->view->form = $form;
        
        $this->view->account = $account;
    }

    /**
     * Delete Action
     */
    public function deleteAction ()
    {
        $account = $this->getAuthModel()->findById($this->getAuthId());
        
        $form = $this->getDeleteForm();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $this->getAuthModel()->delete($this->getAuthId());
                
                $this->setFlashSuccess('The account was delete.');
                
                $this->redirect('/auth/admin/index');
            }
        }
        
        $this->view->form = $form;
        
        $this->view->account = $account;
    }
}