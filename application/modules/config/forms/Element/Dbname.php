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
 * @category   Config
 * @package    Form
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Dbname.php 1.0  Jaimie Garner $
 */
class Config_Form_Element_Dbname extends Zend_Form_Element_Text
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
        
        $this->setLabel('Database')
            ->setRequired(true)
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-4');
        
        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'Database Field is required!'
                        ),
                        'breakChainOnFailure' => false
                )
        )
        ;
        
        $this->addValidators($validators);
    }
}
