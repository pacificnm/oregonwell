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
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Base.php 1.0  Jaimie Garner $
 */
class Application_Form_Base extends Zend_Form
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
     * 
     * @param string $string
     * @return string
     */
    public function translate($string)
    {
        $translate = Zend_Registry::get('Zend_Translate');
        
        $string = (string)$translate->translate($string);
        
        return $string;
    }
}