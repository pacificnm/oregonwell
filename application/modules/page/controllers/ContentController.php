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
 * @version    $Id: ContentController.php 1.0  Jaimie Garner $
 */
class Page_ContentController extends Page_Model_Controller
{
    public function init()
    {
        parent::init();
    }
    
    /**
     * Index action
     */
    public function indexAction()
    {
        $contentModel = new Page_Model_Content();
      
        $page = $this->getParam('name');
        $scriptPath = $this->view->getScriptPaths();
        
        $path = $scriptPath[0] . 'content/';
        $file = $path . $page . '.phtml';
        
        $content = $contentModel->findByName($page);
        
                
        if(count($content) == 0) {
          $file = false;
        }
        
        if(is_file($file)) {
          $this->view->pageTitle = $content->content_title;
          $this->view->headTitle(' - ' . $content->content_title);
          $this->view->headMeta()->setName('keywords', $content->content_keyword);
          $this->view->headMeta()->setName('description', $content->content_description);
          $this->render($page);
          $this->getContentModel()->addHit($content->content_id);
        } else {
          $this->view->pageTitle = 'The Page ' . $page . ' Was Not Found</small>';
          $this->view->headTitle(' - Page Not Found');
          $this->view->headMeta()->setName('keywords', 'Page Not Found');
          $this->view->headMeta()->setName('description', 'The page you requested could not be found.');
          $this->render('404');
        }
    }
    
}