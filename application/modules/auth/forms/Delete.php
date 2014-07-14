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
 * @version    $Id: Delete.php 1.0  Jaimie Garner $
 */
class Auth_Form_Delete extends Application_Form_Form
{

    /**
     * (non-PHPdoc)
     * @see Application_Form_Base::init()
     */
    public function init ()
    {
        
        
        $this->addElement(new Application_Form_Element_Delete('submit'));
    }

    
}