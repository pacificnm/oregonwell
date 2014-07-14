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
 * @version    $Id: DeleteController.php 1.0  Jaimie Garner $
 */
class Acl_DeleteController extends Acl_Model_Controller
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
     * Delete Role Action
     */
    public function roleAction ()
    {
        $role = $this->getRoleModel()->findById($this->getRoleId());
        
        $form = $this->getDeleteForm()->role();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $this->getRoleModel()->delete($this->getRoleId());
                
                $this->setFlashSuccess($this->translate('Role Was Deleted'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->role = $role;
        
        $this->view->form = $form;
    }

    /**
     * Delete Resource Action
     */
    public function resourceAction ()
    {
        $resource = $this->getResourceModel()->findById($this->getResourceId());
        
        $form = $this->getDeleteForm()->resource();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $this->getResourceModel()->delete($this->getResourceId());
                
                $this->setFlashSuccess($this->translate('Resource Was Deleted'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->resource = $resource;
        
        $this->view->form = $form;
    }

    /**
     * Delete Rule Action
     */
    public function ruleAction ()
    {
        $rule = $this->getRuleModel()->findById($this->getRuleId());
        
        $this->view->rule = $rule;
        
        $form = $this->getDeleteForm()->rule();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()
                ->getPost())) {
                
                $this->getRuleModel()->delete($this->getRuleId());
                
                $this->setFlashSuccess($this->translate('Rule Was Deleted'));
                
                $this->redirect('/acl/index');
            }
        }
        
        $this->view->rule = $rule;
        
        $this->view->form = $form;
    }
}
