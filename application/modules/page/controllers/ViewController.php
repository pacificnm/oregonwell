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
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: ViewController.php 1.0  Jaimie Garner $
 */
class Page_ViewController extends Page_Model_Controller
{

    /**
     * (non-PHPdoc)
     *
     * @see Page_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Index Action
     */
    public function indexAction ()
    {
        $this->view->page = $this->getPageModel()->findById($this->getPageId());
        
        // load meta
        $this->view->metas = $this->getPageMetaModel()->findAllByPage(
                $this->getPageId());
    }

    /**
     * View Meta Action
     */
    public function metaAction ()
    {
        // get the meta information
        $meta = $this->getPageMetaModel()->findById($this->getPageMetaId());
        
        $this->view->meta = $meta;
        
        // get the page
        $this->view->page = $this->getPageModel()->findById($meta->page_id);
    }
    
    public function contentAction()
    {
      
      $this->view->contents = $this->getContentModel()->findAll(
              $this->getParam('content_name'), 
              $this->getParam('content_type'),
              1,
              $this->getPage()
          );
    
    }
}