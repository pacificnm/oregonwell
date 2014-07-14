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
 * @version    $Id: DeleteController.php 1.0  Jaimie Garner $
 */
class Page_DeleteController extends Page_Model_Controller {

  /**
   * (non-PHPdoc)
   * 
   * @see Page_Model_Base::init()
   */
  public function init() {
    parent::init();
  }

  /**
   * index action
   */
  public function indexAction() {
    
  }

  /**
   * delete module action
   */
  public function moduleAction() {
    
  }

  /**
   * delete page action
   */
  public function pageAction() {
    
  }

  public function contentAction() {
    $form = $this->getDeleteForm()->content();

    $content = $this->getContentModel()->findById($this->getContentId());
    
    $this->view->content = $content;
    
    // If we have a post
    if ($this->getRequest()->isPost()) {
      
      // if form is valid
      if ($form->isValid($this->getRequest()->getPost())) {
        
        $this->getContentModel()->closeContent($this->getContentId());
        
        $this->setFlashSuccess('The content was deleted.');
        
        $this->redirect('/page/view/content');
      }
    }
    // Display the form
    $this->view->form = $form;
  }

}
