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
 * @version    $Id: CreateController.php 1.0  Jaimie Garner $
 */
class Page_CreateController extends Page_Model_Controller
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
     * create module action
     */
    public function moduleAction ()
    {
        $form = $this->getCreateForm()->module();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $route = 'default';
                $module = $this->getParam('module_name');
                $controller = 'index';
                $action = 'index';
                $aclResourceId = $this->getParam('acl_resource_id');
                
                $pageId = $this->getPageModel()->save($route, $module, 
                        $controller, $action, $aclResourceId);
                
                $this->setFlashSuccess('Module was created.');
                
                $this->redirect('/page/view/index/page_id/' . $pageId);
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * create page action
     */
    public function pageAction ()
    {
        $form = $this->getCreateForm()->page();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $route = 'default';
                $module = $this->getParam('module_name');
                $controller = $this->getParam('controller_name');
                $action = $this->getParam('action_name');
                $aclResourceId = $this->getParam('acl_resource_id');
                
                $pageId = $this->getPageModel()->save($route, $module, 
                        $controller, $action, $aclResourceId);
                
                $this->setFlashSuccess('Page was created');
                
                $this->redirect('/page/view/index/page_id/' . $pageId);
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * create meta action
     */
    public function metaAction ()
    {
        $this->view->page = $this->getPageModel()->findById($this->getPageId());
        
        $form = $this->getCreateForm()->meta();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $language = $this->getParam('language');
                $pageTitle = $this->getParam('page_title');
                $metaTitle = $this->getParam('meta_title');
                $metaDescription = $this->getParam('meta_description');
                $metaKeyword = $this->getParam('meta_keyword');
                
                $metaPageId = $this->getPageMetaModel()->save(
                        $this->getPageId(), $pageTitle, $metaTitle, 
                        $metaDescription, $metaKeyword, $language);
                
                $this->setFlashSuccess('Page Translation was created');
                
                $this->redirect(
                        '/page/view/index/page_id/' . $this->getPageId());
            }
        }
        
        $this->view->form = $form;
    }
    
    public function contentAction()
    {
      
      // check if the content dir is writeable
      $path = $this->view->getScriptPaths();
      $this->view->contentPath = $path[0] . 'content/';
      
     
      
      if(!is_writable($this->view->contentPath)) {
        $this->view->pathError = true;
      }
      
      $form = $this->getCreateForm()->content();
      
      if ($this->getRequest()->isPost()) {
        if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
          // get vars
          $contentType = $this->getParam('content_type');
          $contentTitle = $this->getParam('content_title');
          $contentName = $this->getContentModel()->slugify($contentTitle);
          $contentBody = $this->getParam('content_body');
          $contentDescription = $this->getParam('content_description');
          $contentKeyword = $this->getParam('content_keyword');
          $fileName = $contentName . '.phtml';
          $contentActive = 1;
          $contentHits = 0;
          $contentCreated = time();
          
          // save db
          $this->getContentModel()->save($contentType, $contentName, 
              $contentBody, $contentDescription, $contentKeyword, $contentTitle, 
              $contentActive, $contentHits, $contentCreated);
          
          // save page
          file_put_contents($path.$fileName, $contentBody);
          
          // set flash
          $this->setFlashSuccess('Content was created');
          
          // redirect
        }
      }
      
      $this->view->form = $form;
    }
}