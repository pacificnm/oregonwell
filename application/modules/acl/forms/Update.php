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
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Update.php 1.0  Jaimie Garner $
 */
class Acl_Form_Update extends Application_Form_Base
{

    /**
     * (non-PHPdoc)
     *
     * @see Application_Form_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Create Form for Role
     */
    public function role ($role)
    {
        $element = new Acl_Form_Element_Role_Name('acl_role_name');
        $element->setValue($role->acl_role_name);
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Role_Display('acl_role_display');
        $element->setValue($role->acl_role_display);
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Select_Child('acl_role_child');
        $element->setValue($role->acl_role_child);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Resource
     */
    public function resource ($resource)
    {
        $element = new Acl_Form_Element_Resource_Name('acl_resource_name');
        $element->setValue($resource->acl_resource_name);
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Resource_Display('acl_resource_display');
        $element->setValue($resource->acl_resource_display);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Rule
     */
    public function rule ($rule)
    {
        $element = new Acl_Form_Element_Select_Role('acl_role_id');
        $element->setValue($rule->acl_role_id);
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Select_Type('acl_type');
        $element->setValue($rule->acl_type);
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Select_Resource('acl_resource_id');
        $element->setValue($rule->acl_resource_id);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}