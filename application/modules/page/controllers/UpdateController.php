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
 * @version    $Id: UpdateController.php 1.0  Jaimie Garner $
 */
class Page_UpdateController extends Page_Model_Controller {

  /**
   * (non-PHPdoc)
   *
   * @see Page_Model_Base::init()
   */
  public function init() {
    parent::init();
  }

  /**
   * update index action
   */
  public function indexAction() {
    
  }

  /**
   * Update module action
   */
  public function moduleAction() {
    
  }

  /**
   * update page action
   */
  public function pageAction() {
    $page = $this->getPageModel()->findById($this->getPageId());

    $form = $this->getUpdateForm()->page($page);

    if ($this->getRequest()->isPost()) {
      if ($form->isValid(
              $this->getRequest()
                  ->getPost())) {

        $module = $this->getParam('module_name');
        $controller = $this->getParam('controller_name');
        $action = $this->getParam('action_name');
        $aclResourceId = $this->getParam('acl_resource_id');
        $breadcrumb = $this->getParam('breadcrumb');
        $cache = $this->getParam('cache');

        $this->getPageModel()->save('default', $module, $controller, $action, $aclResourceId, $breadcrumb, $cache, $this->getPageId());

        $this->setFlashSuccess('The Page was updated');

        $this->redirect('/page/view/index/page_id/' . $this->getPageId());
      }
    }

    $this->view->form = $form;
  }

  /**
   * Updates Page Meta information
   */
  public function metaAction() {
    $meta = $this->getPageMetaModel()->findById($this->getPageMetaId());

    $form = $this->getUpdateForm()->meta($meta);

    if ($this->getRequest()->isPost()) {
      if ($form->isValid(
              $this->getRequest()
                  ->getPost())) {

        $pageId = $meta->page_id;

        $pageTitle = $this->getParam('page_title');
        $metaTitle = $this->getParam('meta_title');
        $metaDescription = $this->getParam('meta_description');
        $metaKeyword = $this->getParam('meta_keyword');
        $language = $this->getParam('language');

        // save the data
        $this->getPageMetaModel()->save($pageId, $pageTitle, $metaTitle, $metaDescription, $metaKeyword, $language, $this->getPageMetaId());

        $this->setFlashSuccess('The translation was updated');

        $this->redirect(
            '/page/view/meta/page_meta_id/' . $this->getPageMetaId());
      }
    }

    $this->view->form = $form;
  }

  public function contentAction()
  {
      // check path
      $scriptPath = $this->view->getScriptPaths();
      $path = $scriptPath[0] . 'content/';
        
      
      if(!is_writable($path)) {
        $this->view->pathError = true;
      }
    
    $content = $this->getContentModel()->findById(
        $this->getContentId());
    
    $form = $this->getUpdateForm()->content($content);
    
    if ($this->getRequest()->isPost()) {
      if ($form->isValid(
              $this->getRequest()
                  ->getPost())) {
        // close out old page
        $this->getContentModel()->closeContent($this->getContentId());
        
        // get vars
          $contentType = $this->getParam('content_type');
          $contentTitle = $this->getParam('content_title');
          $contentName = $this->getContentModel()->slugify($contentTitle);
          $contentBody = $this->getParam('content_body');
          $contentDescription = $this->getParam('content_description');
          $contentKeyword = $this->getParam('content_keyword');
          $fileName = $contentName . '.phtml';
          $contentActive = 1;
          $contentHits = $this->getParam('content_hits');
          $contentCreated = time();
          
          $this->getContentModel()->save($contentType, $contentName, $contentBody, 
              $contentDescription, $contentKeyword, $contentTitle, $contentActive, 
              $contentHits, $contentCreated);
          
          // save page
          file_put_contents($path.$fileName, $contentBody);
          
          // set flash
          $this->setFlashSuccess('Content was updated');
          
          $this->redirect('/page/view/content');
          
      }
    }
    
    $this->view->form = $form;
  }
}
