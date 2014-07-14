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
 * @version    $Id: Type.php 1.0  Jaimie Garner $
 */
class Acl_Form_Element_Select_Type extends Application_Form_Element_Select
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        parent::init();
        
        $this->setLabel($this->translate('Rule'))
            ->setAttrib('class', 'form-control')
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('data-size', 'col-xs-3');
        
        $this->addMultiOption('allow', $this->translate('Allow'));
        $this->addMultiOption('deny', $this->translate('Deny'));
    }
}