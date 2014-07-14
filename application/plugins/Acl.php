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
 * @category   Application
 * @package    Plugin
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Acl.php 1.0  Jaimie Garner $
 */
class Application_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    /**
     *
     * @var unknown
     */
    protected $_request = null;

    private $_zendAcl = null;

    private $_identity = null;

    private $_pageAcl = null;

    private $_module = null;

    private $_controller = null;

    private $_action = null;

    private $_resources = null;

    private $_resourceModel = null;

    private $_roleModel = null;

    private $_ruleModel = null;

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $config = Zend_Registry::get('Application_Config');
        
        $this->_request = $request;
        
        Zend_Registry::set('Zend_Acl', $this->getZendAcl());
        
        if ($config->installed == 'true') {
            
            $this->setRoles();
            $this->setResources();
            $this->setRules();
            
            if ($this->getPageAcl() == null) {
            	
            } else {
                if (! $this->getZendAcl()->isAllowed(
                        $this->getIdentity()->acl_role_id, $this->getPageAcl())) {
                    
                    $request->setModuleName('default');
                    $request->setControllerName('error');
                    $request->setActionName('access-denied');
                }
            } 
           
        }
       
        
        
        Zend_Registry::set('Zend_Acl', $this->getZendAcl());
        
        
    }

    /**
     * Sets ACL Roles
     *
     * @throws Zend_Exception
     */
    private function setRoles ()
    {
        try {
            
            $roles = $this->getRoleModel()->findAll();
            
            
            
            foreach ($roles as $role) {
                
                if (! $this->getZendAcl()->hasRole($role->acl_role_id)) {
                    
                    if ($role->acl_role_child > 0) {
                        
                        $this->getZendAcl()->addRole( new Zend_Acl_Role($role->acl_role_id), $role->acl_role_child);
                        
                    } else {
                        $this->getZendAcl()->addRole( new Zend_Acl_Role($role->acl_role_id));
                    }
                   
                }
            }
            
            
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Sets ACL Resources
     *
     * @throws Zend_Exception
     */
    private function setResources ()
    {
        try {
            $resources = $this->getResourceModel()->findAll();
            
            // set up resources
            foreach ($resources as $resource) {
                if (! $this->getZendAcl()->has($resource->acl_resource_id)) {
                    $this->getZendAcl()->addResource($resource->acl_resource_id);
                }
            }
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Sets ACL Rules
     */
    private function setRules ()
    {
        $rules = $this->getRuleModel()->findAll();
        
        foreach ($rules as $rule) {
            if ($rule->acl_type == 'allow') {
                $this->getZendAcl()->allow($rule->acl_role_id, 
                        $rule->acl_resource_id);
            }
        }
    }

    /**
     * Gets Zend Acl
     * 
     * @return Zend_Acl
     */
    private function getZendAcl ()
    {
        
        if (null !== $this->_zendAcl) {
            return $this->_zendAcl;
        } else {
            $this->_zendAcl = new Zend_Acl();
            return $this->_zendAcl;
        }
    }

    /**
     * Gets Session Identity
     *
     * @return object Zend_Auth
     */
    private function getIdentity ()
    {
        if (null !== $this->_identity) {
            return $this->_identity;
        } else {
            $this->_identity = Zend_Auth::getInstance()->getIdentity();
            return $this->_identity;
        }
    }

    /**
     * Gets page Acl
     */
    private function getPageAcl ()
    {
        if (null !== $this->_pageAcl) {
            return $this->_pageAcl;
        } else {
            $PageModelPage = new Page_Model_Page();
            
            $page = $PageModelPage->findByRequest('default', $this->getModule(), 
                    $this->getController(), $this->getAction());
            
            if (! empty($page)) {
                $this->_pageAcl = $page->acl_resource_id;
                return $this->_pageAcl;
            }
        }
    }

    /**
     * Gets the request module name
     * 
     * @return string
     */
    private function getModule ()
    {
        if (null !== $this->_module) {
            return $this->_module;
        } else {
            $this->_module = $this->_request->getModuleName();
            return $this->_module;
        }
    }

    /**
     * gets the request controller name
     *
     * @return string
     */
    private function getController ()
    {
        if (null !== $this->_controller) {
            return $this->_controller;
        } else {
            $this->_controller = $this->_request->getControllerName();
            return $this->_controller;
        }
    }

    /**
     * Gets the request action name
     *
     * @return string
     */
    private function getAction ()
    {
        if (null !== $this->_action) {
            return $this->_action;
        } else {
            $this->_action = $this->_request->getActionName();
            return $this->_action;
        }
    }

    /**
     * Gets ACL resource model
     *
     * @return Acl_Model_Resource
     */
    private function getResourceModel ()
    {
        if (null !== $this->_resourceModel) {
            return $this->_resourceModel;
        } else {
            $this->_resourceModel = new Acl_Model_Resource();
            return $this->_resourceModel;
        }
    }

    /**
     * Gets the ACl Role model
     *
     * @return Acl_Model_Role
     */
    private function getRoleModel ()
    {
        if (null !== $this->_roleModel) {
            return $this->_roleModel;
        } else {
            $this->_roleModel = new Acl_Model_Role();
            return $this->_roleModel;
        }
    }

    /**
     * Gets the ACL Rule model
     *
     * @return Acl_Model_Rule
     */
    private function getRuleModel ()
    {
        if (null !== $this->_ruleModel) {
            return $this->_ruleModel;
        } else {
            $this->_ruleModel = new Acl_Model_Rule();
            return $this->_ruleModel;
        }
    }
}