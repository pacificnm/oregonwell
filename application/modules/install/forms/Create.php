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
 * @category   Install
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Create.php 1.0  Jaimie Garner $
 */
class Install_Form_Create extends Application_Form_Base
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
     * Creates the Application form
     * 
     * @return Install_Form_Create
     */
    public function application ()
    {
        $element = new Config_Form_Element_Name('name');
        
        $this->addElement($element);
        
        $element = new Config_Form_Element_Version('version');
        $element->setValue('Beta 1.2');
        $this->addElement($element);
        
        $this->addElement(new Config_Form_Element_Timezone('time_zone'));
        
        $this->addElement(new Config_Form_Element_Language('language'));
        
        $element = new Config_Form_Element_Theme('theme');
        $element->setValue('cyborg');
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Creates the database form
     * 
     * @return Install_Form_Create
     */
    public function database ()
    {
        $this->addElement(new Config_Form_Element_Host('host'));
        
        $this->addElement(new Config_Form_Element_Username('username'));
        
        $this->addElement(new Config_Form_Element_Password('password'));
        
        $this->addElement(new Config_Form_Element_Dbname('dbname'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Creates the Admin form
     * 
     * @return Install_Form_Create
     */
    public function admin ()
    {
        $this->addElement(new Auth_Form_Element_Name('name'));
        
        $this->addElement(new Auth_Form_Element_Email('email'));
        
        $this->addElement(new Auth_Form_Element_Username('username'));
        
        $this->addElement(new Auth_Form_Element_Password('password'));
        
        $element = new Acl_Form_Element_Select_Role('acl_role_id');
        $element->setValue(3);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}
