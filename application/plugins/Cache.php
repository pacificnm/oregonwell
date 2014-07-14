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
 * @version    $Id: Cache.php 1.0  Jaimie Garner $
 */
class Application_Plugin_Cache extends Zend_Controller_Plugin_Abstract
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Plugin_Abstract::preDispatch()
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $appConfig = Zend_Registry::get('Application_Config');
        
        $cacheDir = APPLICATION_PATH . $appConfig->cache->directory . '/' .
                 $request->getModuleName() . '/' . $request->getControllerName();
        
        if (! is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }
        
        
        
        // echo $request->getModuleName();
        $frontendOptions = array(
                
                'lifetime' => null,
                'automatic_serialization' => true
        );
        
        $backendOptions = array(
                'cache_dir' => $cacheDir
        );
        
        // getting a Zend_Cache_Frontend_Output object
        $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, 
                $backendOptions);
        
        Zend_Registry::set('Zend_Cache', $cache);
        
        Zend_Registry::set('Page_Cache', $this->getPageCache());
        
        
        Zend_Registry::set('Page_Cache_Id', md5(1));
    }
    
    private function getPageCache()
    {

        $appConfig = Zend_Registry::get('Application_Config');
        
        $cacheDir = APPLICATION_PATH . $appConfig->cache->directory . '/page';
        
        if (! is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }
        
        
        $frontendOptions = array(
            'lifetime' => null,                   // cache lifetime of 30 seconds
            'automatic_serialization' => false  // this is the default anyways
        );
  
        
        $backendOptions = array('cache_dir' => $cacheDir);
        
        $cache = Zend_Cache::factory('Output', 'File',
            $frontendOptions,
            $backendOptions);
        
        return $cache;
    }
}