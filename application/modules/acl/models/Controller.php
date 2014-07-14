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
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Base.php 1.0  Jaimie Garner $
 */
class Acl_Model_Controller extends Application_Model_Controller
{
    private $_resourceModel = null;
    
    private $_roleModel = null;
    
    private $_ruleModel = null;
    
    private $_createForm = null;
    
    private $_updateForm = null;
    
    private $_deleteForm = null;
    
    private $_aclResourceId = null;
    
    private $_aclRoleId = null;
    
    private $_aclRuleId = null;
    
    public function init()
    {
        parent::init();
    }
    
    /**
     * Gets Rule Id
     * 
     * @throws Zend_Exception
     * @return int acl_rule_id
     */
    public function getRuleId()
    {
        if (null !== $this->_aclRuleId) {
            return $this->_aclRuleId;
        } else {
            $aclRuleId = $this->getParam('acl_rule_id');
            if($aclRuleId < 1) {
                throw new Zend_Exception($this->translate('Missing acl_rule_id'));
            }
            $this->_aclRuleId = $aclRuleId;
            return $this->_aclRuleId;
        }
    }
    
    public function getRoleId()
    {
        if (null !== $this->_aclRoleId) {
            return $this->_aclRoleId;
        } else {
            $aclRoleId = $this->getParam('acl_role_id');
            if($aclRoleId < 1) {
                throw new Zend_Exception($this->translate('Missing acl_role_id'));
            }
            $this->_aclRoleId = $aclRoleId;
            return $this->_aclRoleId;
        }
    }
    
    
    
    public function getResourceId()
    {
        if (null !== $this->_aclResourceId) {
            return $this->_aclResourceId;
        } else {
            $aclResourceId = $this->getParam('acl_resource_id');
            if($aclResourceId < 1) {
                throw new Zend_Exception($this->translate('Missing acl_resource_id'));
            }
            $this->_aclResourceId = $aclResourceId;
            return $this->_aclResourceId;
        }
    }
    
    
    public function getCreateForm()
    {
        if (null !== $this->_createForm) {
            return $this->_createForm;
        } else {
            $this->_createForm = new Acl_Form_Create();
            return $this->_createForm;
        }
    }
    
    public function getUpdateForm()
    {
        if (null !== $this->_updateForm) {
            return $this->_updateForm;
        } else {
            $this->_updateForm = new Acl_Form_Update();
            return $this->_updateForm;
        }
    }
    
    
    public function getDeleteForm()
    {
        if (null !== $this->_deleteForm) {
            return $this->_deleteForm;
        } else {
            $this->_deleteForm = new Acl_Form_Delete();
            return $this->_deleteForm;
        }
    }
    
    
    public function getResourceModel()
    {
        if (null !== $this->_resourceModel) {
            return $this->_resourceModel;
        } else {
            $this->_resourceModel = new Acl_Model_Resource();
            return $this->_resourceModel;
        }
    }
    
    public function getRoleModel()
    {
        if (null !== $this->_roleModel) {
            return $this->_roleModel;
        } else {
            $this->_roleModel = new Acl_Model_Role();
            return $this->_roleModel;
        }
    }
    
    public function getRuleModel()
    {
        if (null !== $this->_ruleModel) {
            return $this->_ruleModel;
        } else {
            $this->_ruleModel = new Acl_Model_Rule();
            return $this->_ruleModel;
        }
    }
}