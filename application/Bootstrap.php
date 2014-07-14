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
 * @package    Bootstrap
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Bootstrap.php 1.0  Jaimie Garner $
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Initilizes Application config
     * 
     * @throws Zend_Exception
     */
    public function _initConfig ()
    {
    	
    	if(APPLICATION_ENV == 'development') {
    		
    	} else {
        	$configPath = APPLICATION_PATH . '/configs/config.xml';
    	}
    	$configPath = APPLICATION_PATH . '/configs/devconfig.xml';
        
        // test if is file
        if (! is_File($configPath)) {
            throw new Zend_Exception('Missing config file');
        } else {
            $appConfig = new Zend_Config_Xml($configPath);
            
            Zend_Registry::set('Application_Config', $appConfig);
        }
    }

    protected function _initRoutes()
    {
        $frontController = Zend_Controller_Front::getInstance();
        //$frontController->setParam('useDefaultActionAlways', true);
        
        $router = $frontController->getRouter();
    
        //route for static conetent
        /**
        $route = new Zend_Controller_Router_Route(
                '/page/content',
                array(  
                        'module'     => 'page',
                        'controller' => 'content',
                        'action'     => 'index',
                )
        );
        $router->addRoute('cotactus', $route);
        */
        $route = new Zend_Controller_Router_Route(
                'page/content/:name',
                 array(  'module' => 'page',
                         'controller' => 'content',
                         'action' => 'index',
                         'name' => 'index'
                         
            ));
        $router->addRoute('page', $route);
        
        
        $route = new Zend_Controller_Router_Route(
             'it-service/:name',
                 array(  'module' => 'page',
                         'controller' => 'content',
                         'action' => 'index',
                         'name' => 'index'
                 )
            );
        $router->addRoute('it_service', $route);
        
        $route = new Zend_Controller_Router_Route(
             'news/:name',
                 array(  'module' => 'page',
                         'controller' => 'content',
                         'action' => 'index',
                         'name' => 'index'
                 )
            );
        $router->addRoute('news', $route);
        
        $route = new Zend_Controller_Router_Route(
             'article/:name',
                 array(  'module' => 'page',
                         'controller' => 'content',
                         'action' => 'index',
                         'name' => 'index'
                 )
            );
        $router->addRoute('article', $route);
        
        $route = new Zend_Controller_Router_Route(
                'register/:action/',
                array(
                        'module' => 'auth',
                        'controller' => 'register',
                        'action' => 'index'
                        
                )   
        );
        $router->addRoute('register', $route);
    }
    
    /**
     * Initializes date format
     */
    public function _initDate ()
    {
        $config = Zend_Registry::get('Application_Config');
        
        $timeZone = $config->time_zone;
        
        date_default_timezone_set($timeZone);
    }

    /**
     * Initializes Auth Object
     */
    public function _initAuth ()
    {
        $Auth = Zend_Auth::getInstance();
        $Identity = $Auth->getIdentity();
        
        if (empty($Identity)) {
            $content = new stdClass();
            $content->auth_id = 0;
            $content->name = 'Guest';
            $content->username = 'guest';
            $content->auth_type = 'Guest';
            $content->acl_role_id = '1';
            
            $Auth->getStorage()->write($content);
            
                        
            $Auth = Zend_Auth::getInstance();
            $Identity = $Auth->getIdentity();
        }
        Zend_Registry::set('Zend_Auth', $Auth);
        Zend_Registry::set('identity', $Identity);
    }

    /**
     * Initializes database
     */
    protected function _initDatabase ()
    {
        $dbAdapter = Zend_Db::factory(
                Zend_Registry::get('Application_Config')->db->adapter, 
                Zend_Registry::get('Application_Config')->db->params->toArray());
        
        Zend_Registry::set('dbAdapter', $dbAdapter);
        
        Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);
    }

    /**
     * Initializes Plugins
     */
    protected function _initPlugins ()
    {
        $front = Zend_Controller_Front::getInstance();
        
        if (PHP_SAPI != 'cli') {
            $front->registerPlugin(new Application_Plugin_Cache());
            $front->registerPlugin(new Application_Plugin_Translate());
            $front->registerPlugin(new Application_Plugin_Acl());
            $front->registerPlugin(new Application_Plugin_Navigation());
            $front->registerPlugin(new Application_Plugin_Meta());
            
        }
    }
    
    

    /**
     * Initializes Debug
     */
    protected function _initZFDebug ()
    {
        $config = Zend_Registry::get('Application_Config');
        
        if ($config->debug_enabled == 'true') {
            if (PHP_SAPI != 'cli') {
                $auth = Zend_Auth::getInstance();
                
                $autoloader = Zend_Loader_Autoloader::getInstance();
                $autoloader->registerNamespace('ZFDebug');
                
                $db = Zend_Registry::get('dbAdapter');
                
                $options = array(
                        'plugins' => array(
                                'Variables',
                                'Database' => array(
                                        'adapter' => $db
                                ),
                                'File' => array(
                                        'basePath' => APPLICATION_PATH
                                ),
                                // 'Cache' => array('backend' =>
                                // $cache->getBackend()),
                                // 'Time',
                                // 'Registry',
                                // 'auth',
                                'Html',
                                'Exception'
                        )
                );
                
                $debug = new ZFDebug_Controller_Plugin_Debug($options);
                
                $this->bootstrap('frontController');
                $frontController = $this->getResource('frontController');
                $frontController->registerPlugin($debug);
            }
        }
    }
}

