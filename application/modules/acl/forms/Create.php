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
 * @version    $Id: Create.php 1.0  Jaimie Garner $
 */
class Acl_Form_Create extends Application_Form_Base
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
    public function role ()
    {
        $this->addElement(new Acl_Form_Element_Role_Name('acl_role_name'));
        
        $this->addElement(new Acl_Form_Element_Role_Display('acl_role_display'));
        
        $this->addElement(new Acl_Form_Element_Select_Child('acl_role_child'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Resource
     */
    public function resource ()
    {
        $this->addElement(new Acl_Form_Element_Resource_Name('acl_resource_name'));
        
        $this->addElement(new Acl_Form_Element_Resource_Display('acl_resource_display'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Rule
     */
    public function rule ()
    {
        $this->addElement(new Acl_Form_Element_Select_Role('acl_role_id'));
        
        $this->addElement(new Acl_Form_Element_Select_Type('acl_type'));
        
        $this->addElement(new Acl_Form_Element_Select_Resource('acl_resource_id'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}