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
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Update.php 1.0  Jaimie Garner $
 */
class Auth_Form_Update extends Application_Form_Base
{

    /**
     * (non-PHPdoc)
     * @see Application_Form_Base::init()
     */
    public function init ()
    {
       parent::init();
    }

    /**
     * Admin Update Account Form
     * 
     * @param object $account Auth_Model_Auth
     * @return Auth_Form_Update
     */
    public function admin($account)
    {
        $element = new Auth_Form_Element_Name('name');
        $element->setValue($account->name);
        $this->addElement($element);
        
        $element = new Auth_Form_Element_UpdateEmail('email');
        $element->setValue($account->email);
        $this->addElement($element);
        
        $element = new Auth_Form_Element_UpdateUsername('username');
        $element->setValue($account->username); 
        $this->addElement($element);
        
        $element = new Acl_Form_Element_Select_Role('acl_role_id');
        $element->setvalue($account->acl_role_id);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
    
        return $this;
    }
    
    /**
     * Update Account Form
     * 
     * @param object $account Auth_Model_Auth
     */
    public function account($account)
    {
        $element = new Auth_Form_Element_Name('name');
        $element->setValue($account->name);
        $this->addElement($element);
        
        $element = new Auth_Form_Element_UpdateEmail('email');
        $element->setValue($account->email);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
    
    public function password()
    {
        $this->addElement(new Auth_Form_Element_Password('password'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}