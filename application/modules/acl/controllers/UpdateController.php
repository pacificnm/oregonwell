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
 * @category   Acl
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: UpdateController.php 1.0  Jaimie Garner $
 */
class Acl_UpdateController extends Acl_Model_Controller
{

    /**
     * (non-PHPdoc)
     *
     * @see Acl_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    public function indexAction()
    {
        
    }
    
    /**
     * Update Role Action
     */
    public function roleAction ()
    {
        $role = $this->getRoleModel()->findById($this->getRoleId());
        
        $form = $this->getUpdateForm()->role($role);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclRoleName = strtolower($this->getParam('acl_role_name'));
                $aclRoleDisplay = $this->getParam('acl_role_display');
                $aclRoleChild = $this->getParam('acl_role_child');
                
                $this->getRoleModel()->save($aclRoleName, $aclRoleDisplay, 
                        $aclRoleChild, $this->getRoleId());
                
                $this->setFlashSuccess($this->translate('Role Was Updated'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Update Resource Action
     */
    public function resourceAction ()
    {
        $resource = $this->getResourceModel()->findById($this->getResourceId());
        
        $form = $this->getUpdateForm()->resource($resource);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclResourceName = strtolower(
                        $this->getParam('acl_resource_name'));
                $aclResourceDisplay = $this->getParam('acl_resource_display');
                
                $this->getResourceModel()->save($aclResourceName, 
                        $aclResourceDisplay, $this->getResourceId());
                
                $this->setFlashSuccess($this->translate('Resource Was Updated'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Update Rule Action
     */
    public function ruleAction ()
    {
        $rule = $this->getRuleModel()->findById($this->getRuleId());
        
        $form = $this->getUpdateForm()->rule($rule);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclResourceId = $this->getParam('acl_resource_id');
                $aclRoleId = $this->getParam('acl_role_id');
                $aclType = $this->getParam('acl_type');
                
                $this->getRuleModel()->save($aclResourceId, $aclRoleId, 
                        $aclType, $this->getRuleId());
                
                $this->setFlashSuccess($this->translate('Rule Was Updated'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->form = $form;
    }
}
