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
 * @package    View
 * @subpackage Helper
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: AclNav.php 1.0  Jaimie Garner $
 */
class Acl_View_Helper_AclNav extends Zend_View_Helper_Abstract
{

    /**
     * Creates the Acl Navigation Menu
     * 
     * @return string
     */
    public function AclNav ()
    {
        $html = '
                <div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">Help</a></li>
				<li ';
        if ($this->getRequest()->getControllerName() == 'index')
            $html .= ' class="active"';
        $html .= '><a href="/acl">Acls</a></li>
				        
				<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionKey() == 'role')
            $html .= ' class="active"';
        $html .= '><a href="/acl/create/role">Create Role</a></li>
				        
				<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'resource')
            $html .= ' class="active"';
        $html .= '><a href="/acl/create/resource">Create Resource</a></li>
				        
				<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'rule')
            $html .= ' class="active"';
        $html .= '><a href="/acl/create/rule">Create Rule</a></li>
			</ul>
		</div>';
        
        return $html;
    }

    /**
     * Gets Request Object
     *
     * @return Zend_Controller_Request_Abstract
     */
    private function getRequest ()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        
        return $request;
    }
}