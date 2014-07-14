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
 * @category   Cache
 * @package    View
 * @subpackage Helper
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Nav.php 1.0  Jaimie Garner $
 */
class Cache_View_Helper_Nav extends Zend_View_Helper_Abstract
{
    /**
     * 
     * @return string
     */
    public function Nav()
    {
        $html = '
                <div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">Help</a></li>
				<li ';
        
        // index
        if($this->getRequest()->getControllerName() == 'index' &&
            $this->getRequest()->getActionName() == 'index') $html .=' class="active"';
        $html .='><a href="/cache/index/index">Caches</a></li>';
        
        // clear all
        $html .= '<li';
        if($this->getRequest()->getControllerName() == 'index' &&
            $this->getRequest()->getActionName() == 'clean') $html .=' class="active" ';
        $html .='><a href="/cache/index/clean">Clean All Caches</a></li>';
        
        // rebuild all
        $html .= '<li';
        if($this->getRequest()->getControllerName() == 'index' && 
            $this->getRequest()->getActionName() == 'rebuild') $html .=' class="active" ';
        $html .='><a href="/cache/index/rebuild">Rebuild Caches</a></li>';
        
        $html .='</ul>
		</div>';
        
        return $html;
    }
    
    /**
     * 
     * @return Zend_Controller_Request_Abstract
     */
    private function getRequest()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();
    
        return $request;
    }
}