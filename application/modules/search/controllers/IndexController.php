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
 * @category   Search
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: IndexController.php 1.0  Jaimie Garner $
 */
class Search_IndexController extends Application_Model_Controller
{
    
    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $text = $this->getParam('search');
        
        $indexPath = APPLICATION_PATH . '/search';
        
        $index = Zend_Search_Lucene::open($indexPath);
        
        $hits = $index->find($text);
        
        $this->view->hits = $hits;
        
        $this->view->search = $text;
        //Zend_Debug::dump($hits);
        
        $title = $this->view->pageTitle . ' <small>- ' . $text . '</small>';
        
        $this->view->pageTitle = $title;
        
        $this->view->headTitle(' - ' . $text);
    }
}