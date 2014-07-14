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
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Save.php 1.0  Jaimie Garner $
 */
class Application_Form_Element_Save extends Zend_Form_Element_Submit
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        $translate = Zend_Registry::get('Zend_Translate');
        
        $this->removeDecorator('default');
        $this->setLabel($translate->translate('Save'));
        $this->setAttrib('class', 'btn btn-primary');
        $this->setDecorators(
                array(
                        array(
                                'ViewHelper'
                        ),
                        array(
                                'Description'
                        ),
                        array(
                                'HtmlTag',
                                array(
                                        'tag' => 'div',
                                        'class' => 'col-sm-offset-1'
                                )
                        )
                ));
    }
}