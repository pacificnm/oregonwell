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
 * @category   Page
 * @package    View
 * @subpackage Helper
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: PageNav.php 1.0  Jaimie Garner $
 */
class Page_View_Helper_PageNav extends Zend_View_Helper_Abstract
{

    /**
     * Creates the Page Navigation menu
     * 
     * @return string html
     */
    public function PageNav ()
    {
        $html = '<div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">Help</a></li>';
        // index
        $html .= '<li';
        if ($this->getRequest()->getControllerName() == 'index')
            $html .= ' class="Active" ';
        $html .= '><a href="/page/index">Pages</a></li>';
        
        // view page
        if ($this->getRequest()->getControllerName() == 'view' &&
                 $this->getRequest()->getActionName() == 'index') {
            $html .= '<li class="active"><a href="#">View Page</a></li>';
        }
        
        // create module
        $html .= '<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'module')
            $html .= ' class="Active" ';
        $html .= '><a href="/page/create/module">Create Module</a></li>';
        
        // create page
        $html .= '<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'page')
            $html .= ' class="active" ';
        $html .= '><a href="/page/create/page">Create Page</a></li>';
        
        $html .= '<li';
        if ($this->getRequest()->getControllerName() == 'view' &&
                 $this->getRequest()->getActionName() == 'content')
            $html .= ' class="active" ';
        $html .= '><a href="/page/view/content">View Content</a></li>';
        
        
        
        // create content
        $html .= '<li';
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'content')
            $html .= ' class="active" ';
        $html .= '><a href="/page/create/content">Create Content</a></li>';
        
        
        
        // create translation
        if ($this->getRequest()->getControllerName() == 'view' &&
                 $this->getRequest()->getActionName() == 'index') {
            
            $html .= '<li><a href="/page/create/meta/page_id/' .
             $this->getRequest()->getParam('page_id') .
             '">Create Translation</a></li>';
        }
        
        // create translation
        if ($this->getRequest()->getControllerName() == 'create' &&
                 $this->getRequest()->getActionName() == 'meta') {
            
            $html .= '<li class="active"><a href="#">Create Translation</a></li>';
        }
        
        // View Translation
        if ($this->getRequest()->getControllerName() == 'view' &&
                 $this->getRequest()->getActionName() == 'meta') {
            
            $html .= '<li class="active"><a href="#">View Translation</a></li>';
        }
        
        // update translation
        if ($this->getRequest()->getControllerName() == 'update' &&
                $this->getRequest()->getActionName() == 'meta') {
            $html .= '<li class="active"><a href="#">Update Translation</a></li>';
        }
        
        // update content
        if ($this->getRequest()->getControllerName() == 'update' &&
                $this->getRequest()->getActionName() == 'content') {
            $html .= '<li class="active"><a href="#">Edit Page</a></li>';
        }
        
        // delete content
        if ($this->getRequest()->getControllerName() == 'delete' &&
                $this->getRequest()->getActionName() == 'content') {
            $html .= '<li class="active"><a href="#">Delete Page</a></li>';
        }
        
        $html .= '</ul></div>';
        
        return $html;
    }

    /**
     * Gets the Request Object
     * 
     * @return Ambigous <NULL, Zend_Controller_Request_Abstract>
     */
    private function getRequest ()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        
        return $request;
    }
}