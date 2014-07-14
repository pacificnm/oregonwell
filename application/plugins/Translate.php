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
 * @version    $Id: Translate.php 1.0  Jaimie Garner $
 */
class Application_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $locale = new Zend_Locale('en_US');
        
        Zend_Registry::set('Zend_Locale', $locale);
        
        $session = new Zend_Session_Namespace('session');
        
        $langLocale = isset($session->lang) ? $session->lang : $locale;
        
        Zend_Translate::setCache($this->getcache());
        
        $translate = new Zend_Translate(
                'tmx', 
                APPLICATION_PATH . '/modules/default/languages/', 
                $langLocale . '.xml', array('disableNotices' => false)  
        );
        
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH .'/log/translation.txt');
        
        $log    = new Zend_Log($writer);
        
        // loop thorugh all language directories and load them
        $directory = scandir(APPLICATION_PATH . '/modules/');
        
        foreach ($directory as $path) {
            if ($path != '.' && $path != '..') {
                
                $filename = APPLICATION_PATH . '/modules/' . $path .
                         '/languages/' . $locale . '.xml';
                
                if (is_file($filename)) {
                    
                    $langFile = APPLICATION_PATH . '/modules/' . $path .
                             '/languages/';
                    
                    $moduleTranslate = new Zend_Translate('tmx', $langFile, 
                            $locale . '.xml', array(
                                    'disableNotices' => false
                            ));
                    
                    $translate->addTranslation($moduleTranslate);
                }
            }
        }
        
        $translate->setOptions(
                array(
                        'log'             => $log,
                        'logUntranslated' => true
                )
        );
        
        // save to registry
        $registry = Zend_Registry::getInstance();
        
        $registry->set('Zend_Translate', $translate);
        
        $messageIds = $translate->getMessageIds();
        
        $source = $translate->getMessages();
    }
    
    private function getcache()
    {
        $appConfig = Zend_Registry::get('Application_Config');
        
        $cacheDir = APPLICATION_PATH . $appConfig->cache->directory . '/language';
        
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
        
        return $cache;
    }
}