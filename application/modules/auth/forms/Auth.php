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
 * @version    $Id: Auth.php 1.0  Jaimie Garner $
 */
class  Auth_Form_Auth extends Zend_Form
{
    /**
     * (non-PHPdoc)
     * @see Zend_Form::init()
     */
    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
    
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');
    }
    
    /**
     * Signin Form
     * 
     * @return Auth_Form_Auth
     */
	public function signin()
	{
		$element = new Zend_Form_Element_Text('username');
		$element->setLabel('Username')
			->setRequired(true)
		     ->setDecorators(array('Decorator'))
		     ->setAttrib('class', 'form-control')
		     ->setAttrib('data-size', 'col-md-6');
		$this->addElement($element);
		
		$element = new Zend_Form_Element_Password('password');
		$element->setLabel('Password')
			->setRequired(true)
		    ->setDecorators(array('Decorator'))
		    ->setAttrib('class', 'form-control')
		    ->setAttrib('data-size', 'col-md-6');
		$this->addElement($element);
		
		$this->addElement(new Auth_Form_Element_Signin('submit'));
		
		return $this;
	}

}