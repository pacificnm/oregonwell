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
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: UpdateUsername.php 1.0  Jaimie Garner $
 */
class Auth_Form_Element_UpdateUsername extends Zend_Form_Element_Text
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 
                'decorator');
        
        $this->setLabel('Username')
            ->setRequired(true)
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-3');
        
        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'Username Field is required!'
                        ),
                        'breakChainOnFailure' => false
                ),
                array(
                        'validator' => 'Alnum',
                        'options' => array(
                                'messages' => 'Only Alpha Numeric characters allowed!'
                        ),
                        'breakChainOnFailure' => true
                )
        )
        ;
        
        $this->addValidators($validators);
    }
}