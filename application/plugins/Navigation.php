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
 * @version    $Id: Navigation.php 1.0  Jaimie Garner $
 */
class Application_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{

    /**
     * (non-PHPdoc)
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
                'viewRenderer');
        
        $config = Zend_Registry::get('Application_Config');
        
        $acl = Zend_Registry::get('Zend_Acl');
        
        if($config->insatlled != 'true') {
            $identity = new stdClass();
            $identity->auth_type = "NULL";
            $identity->acl_role_id = null;
        } else {
        
            $identity = Zend_Registry::get('identity');
        }
        if (null === $viewRenderer->view) {
            $viewRenderer->initView();
        }
        $view = $viewRenderer->view;
        
        
       
        
            switch($identity->auth_type) {
            	case 'Employee':
            	    $configPath = APPLICATION_PATH . '/configs/employeeNavigation.xml';
            	    $config = new Zend_Config_Xml($configPath, 'navigation');
            	    break;
            	case 'Client':
            	    $configPath = APPLICATION_PATH . '/configs/clientNavigation.xml';
            	    $config = new Zend_Config_Xml($configPath, 'navigation');
            	break;
            	default:
            	    $configPath = APPLICATION_PATH . '/configs/navigation.xml';
            	    $config = new Zend_Config_Xml($configPath, 'navigation');
            }
        
        $nav = new Zend_Navigation($config);      
        
        $view->navigation()->setAcl($acl)->setRole($identity->acl_role_id);
        
        $view->navigation($nav);
        
        $pages = $view->navigation()->getContainer()->findAllBy('params_id','id');
        
        Zend_Registry::set('Zend_Navigation', $nav);
    }
}