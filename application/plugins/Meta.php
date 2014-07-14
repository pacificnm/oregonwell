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
 * @category   Application
 * @package    Plugin
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Meta.php 1.0  Jaimie Garner $
 */
class Application_Plugin_Meta extends Zend_Controller_Plugin_Abstract
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $config = Zend_Registry::get('Application_Config');
        
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
                'viewRenderer');
        
        if (null === $viewRenderer->view) {
            $viewRenderer->initView();
        }
        $view = $viewRenderer->view;
        
        $doctypeHelper = new Zend_View_Helper_Doctype();
        
        $doctypeHelper->doctype('HTML5');
        
        if ($config->installed == 'true') {
            
            $route = 'default';
            $module = $request->getModuleName();
            $controller = $request->getControllerName();
            $action = $request->getActionName();
            
            $language = 'en_Us';
            
            // load page
            
            $PageModelPage = new Page_Model_Page();
            $page = $PageModelPage->findByRequest($route, $module, $controller, 
                    $action);
            
            if (! empty($page)) {
                // load translation
                
                $PageModelPageMeta = new Page_Model_Page_Meta();
                $meta = $PageModelPageMeta->findByPageLanguage($page->page_id, 
                        $language);
                
                
                $view->breadcrumbEnabled = $page->breadcrumb;
                $view->pageCache = $page->cache;
                
                if (! empty($meta)) {
                    $view->pageTitle = $meta->page_title;
                    $view->headTitle($meta->meta_title);
                    $view->headMeta()->appendName('keywords', 
                            $meta->meta_keyword);
                    $view->headMeta()->appendName('description', 
                            $meta->meta_description);
                } else {
                    $view->pageTitle = 'Unknown Page  <small>- Please Update the page translation</small>';
                    $view->headTitle('Unknown Page');
                }
            } else {
                $view->pageTitle = 'Unknown Page  <small>- Please Update the page module</small>';
                $view->headTitle('Unknown Page');
            }
        } else {
            $view->pageTitle = 'Install Application';
            $view->headTitle('Install Application');
        }
        
        $view->headMeta()
            ->appendName('viewport', 'width=device-width, initial-scale=1.0')
            ->appendName('author', 'Jaimie Garner');
        
        $view->headLink()->appendStylesheet('/dist/css/style.css');
    }
}