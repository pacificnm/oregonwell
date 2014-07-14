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
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Delete.php 1.0  Jaimie Garner $
 */
class Acl_Form_Delete extends Application_Form_Base
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
     * Create Form for Role
     */
    public function role ()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Resource
     */
    public function resource ()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    /**
     * Create form for Rule
     */
    public function rule ()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}