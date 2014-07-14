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
 * @version    $Id: CreateController.php 1.0  Jaimie Garner $
 */
class Acl_CreateController extends Acl_Model_Controller
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

    /**
     * Create Role Action
     */
    public function roleAction ()
    {
        $form = $this->getCreateForm()->role();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclRoleName = strtolower($this->getParam('acl_role_name'));
                $aclRoleDisplay = $this->getParam('acl_role_display');
                $aclRoleChild = $this->getParam('acl_role_child');
                
                $aclRoleId = $this->getRoleModel()->save($aclRoleName, 
                        $aclRoleDisplay, $aclRoleChild);
                
                $this->setFlashSuccess('Role Was Created');
                
                
                
                $this->redirect('/acl/index/index');
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * Create Resource Action
     */
    public function resourceAction ()
    {
        $form = $this->getCreateForm()->resource();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclResourceName = strtolower(
                        $this->getParam('acl_resource_name'));
                $aclResourceDisplay = $this->getParam('acl_resource_display');
                
                $aclResourceId = $this->getResourceModel()->save(
                        $aclResourceName, $aclResourceDisplay);
                
                $this->setFlashSuccess('Resource Was Created');
                
                $this->redirect('/acl/index/index');
            }
        }
        $this->view->form = $form;
    }

    /**
     * Create Rule Action
     */
    public function ruleAction ()
    {
        $form = $this->getCreateForm()->rule();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $aclResourceId = $this->getParam('acl_resource_id');
                $aclRoleId = $this->getParam('acl_role_id');
                $aclType = $this->getParam('acl_type');
                
                $aclRuleId = $this->getRuleModel()->save($aclResourceId, 
                        $aclRoleId, $aclType);
                
                $this->setFlashSuccess('Rule Was Created');
                
                $this->redirect('/acl/index/index');
            }
        }
        
        $this->view->form = $form;
    }
}