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
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Name.php 1.0  Jaimie Garner $
 */
class Acl_Form_Element_Role_Name extends Application_Form_Element_Text
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        parent::init();
        
        $this->setLabel($this->translate('Name'))
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
                                'messages' => $this->translate('Name Field is required!')
                        ),
                        'breakChainOnFailure' => false
                ),
                array(
                        'validator' => 'Alpha',
                        'options' => array(
                                'messages' => $this->translate('Display Field must contain only Alpha Characters!')
                        ),
                        'breakChainOnFailure' => true
                )
        );
        
        $this->addValidators($validators);
    }
}