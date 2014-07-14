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
 * @version    $Id: Create.php 1.0  Jaimie Garner $
 */
class Auth_Form_Create extends Application_Form_Base
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
     * Admin Create Account Form
     * 
     * @return Auth_Form_Create
     */
    public function admin ()
    {
        $this->addElement(new Auth_Form_Element_Name('name'));
        
        $this->addElement(new Auth_Form_Element_Email('email'));
        
        $this->addElement(new Auth_Form_Element_Username('username'));
        
        $this->addElement(new Auth_Form_Element_Password('password'));
        
        $this->addElement(new Acl_Form_Element_Select_Role('acl_role_id'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
    
    /**
     * Create Account Form
     * @return Auth_Form_Create
     */
    public function account ()
    {
        $this->addElement(new Auth_Form_Element_Name_First('firstName'));
    
        $this->addElement(new Auth_Form_Element_Name_Last('lastName'));
        
        $this->addElement(new Auth_Form_Element_Email('email'));
    
        $this->addElement(new Auth_Form_Element_Password('password'));
        
        $this->addElement(new Auth_Form_Element_Street('street'));
        
        $this->addElement(new Auth_Form_Element_City('city'));
        
        $this->addElement(new Auth_Form_Element_State('state'));
        
        $this->addElement(new Auth_Form_Element_Zip('postcode'));
        
        $this->addElement(new Auth_Form_Element_Phone('phone'));
    
        $this->addElement(new Auth_Form_Element_CreditCardName('ccName'));
        
        $this->addElement(new Auth_Form_Element_CreditCardNumber('ccNumber'));
        
        $this->addElement(new Auth_Form_Element_CreditCardCVV('ccCvv'));
        
        $this->addElement(new Auth_Form_Element_CreditCardMonth('cvvMonth'));
        
        $this->addElement(new Auth_Form_Element_CreditCardYear('cvvYear'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
    
        $this->addElement(new Application_Form_Element_Hash('hash'));
    
        return $this;
    }
}