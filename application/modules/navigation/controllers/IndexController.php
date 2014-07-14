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
 * @category   Navigation
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: IndexController.php 1.0  Jaimie Garner $
 */
class Navigation_IndexController extends Navigation_Model_Controller
{

    public function init ()
    {
        parent::init();
    }

    public function indexAction ()
    {
        $navigations = $this->getNavigationModel()->findByParent($this->getParentId());
        
        $this->view->navigations = $navigations;
    }

    public function viewAction ()
    {
        $configPath = APPLICATION_PATH . '/configs/navigation.xml';
        
        $config = new Zend_Config_Xml($configPath, 'navigation');
        
        $this->view->config = $config->{$this->getId()};
        
        $this->view->configs = $config->{$this->getId()}->toArray();
        
        // Zend_Debug::dump(($this->view->configs));
        // die;
    }

    public function importAction ()
    {
        $config = new Zend_Config_Xml($this->getConfigFile(), 'navigation');
        
        $this->getNavigationModel()->truncate();
        
        foreach ($config as $key => $value) {
            
            echo $key . '<br />';
            $parentId = 0;
            $label = $config->{$key}->label;
            $module = $config->{$key}->module;
            $controller = $config->{$key}->controller;
            $action = $config->{$key}->action;
            $aclResourceId = $config->{$key}->resource;
            $visible = $config->{$key}->visible;
            $resetParams = 'true';
            
            $navigationId = $this->getNavigationModel()->save($parentId, $key, $label, $module, 
                    $controller, $action, $aclResourceId, $visible, $resetParams);
           
            if($config->{$key}->pages) {
                
                foreach($config->{$key}->pages as $pageKey => $pageValue) {
                    echo $pageKey . '<br />';
                    
                   
                   
                    $parentId = $navigationId;
                    $label = $config->{$key}->pages->{$pageKey}->label;
                    $module = $config->{$key}->pages->{$pageKey}->module;
                    $controller = $config->{$key}->pages->{$pageKey}->controller;
                    $action = $config->{$key}->pages->{$pageKey}->action;
                    $aclResourceId = $config->{$key}->pages->{$pageKey}->resource;
                    $visible = $config->{$key}->pages->{$pageKey}->visible;
                    $resetParams = 'true';
                   
                    $navigationId2 = $this->getNavigationModel()->save($parentId, $pageKey, $label, $module,
                            $controller, $action, $aclResourceId, $visible, $resetParams);
                   
                    // level 3 pages
                    if($config->{$key}->pages->{$pageKey}->pages) {
                        
                       foreach($config->{$key}->pages->{$pageKey}->pages as $page2Key => $page2Value) {
                           echo $page2Key . '<br />';
                           $parentId = $navigationId2;
                           $label = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->label;
                           $module = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->module;
                           $controller = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->controller;
                           $action = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->action;
                           $aclResourceId = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->resource;
                           $visible = $config->{$key}->pages->{$pageKey}->pages->{$page2Key}->visible;
                           $resetParams = 'true';
                            
                           if(empty($visible)) {
                               echo $page2Key;
                               die;
                           }
                           
                           $navigationId3 = $this->getNavigationModel()->save($parentId, $page2Key, $label, $module,
                                   $controller, $action, $aclResourceId, $visible, $resetParams);
                            
                           // level 4 pages
                       }
                    }
                }
            }
        }
        
        // Zend_Debug::dump($config);
    }
    
    public function exportAction()
    {
        
    }
}