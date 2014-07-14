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
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Base.php 1.0  Jaimie Garner $
 */
class Application_Model_Controller extends Zend_Controller_Action
{

    /**
     *
     * @var Zend_View_Helper_Abstract
     */
    private $_flashMessenger = null;

    /**
     *
     * @var int
     */
    private $_page = null;

    /**
     *
     * @var Zend_Config_Xml
     */
    private $_appConfig = null;

    
    
    
    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Action::init()
     */
    public function init ()
    {
        
        
        // check if we are installed
        
        if($this->getAppConfig()->installed != 'true') {
            $this->redirect('/install/index');
        }
        
        // setup flash messenger
        $this->_initFlashMessenger();
      
        if(php_sapi_name() != 'cli') {
      
            
            // Add appConfig to view
            $this->view->appConfig = $this->getAppConfig();
            
            // add acl to view
            $this->view->appAcl = Zend_Registry::get('Zend_Acl');
            
            // add identity to view
            $this->view->identity = Zend_Registry::get('identity');
            
            // set default view helper path
            $this->view->addHelperPath(APPLICATION_PATH . '/modules/default/views/helpers', 'Default_View_Helper');
            
            $this->view->addHelperPath(APPLICATION_PATH . '/modules/register/views/helpers',
                    'Register_View_Helper');
                 
        }
        
    }
    
    
    public function getCrypt()
    {
        return new Application_Model_Crypt();
    }
    
    public function translate($string)
    {
        $translate = Zend_Registry::get('Zend_Translate');
        
        $string = $translate->translate($string);
        
        return $string;
    }

    /**
     * Returns the page number from request
     *
     * @return int page
     */
    protected function getPage ()
    {
        if (null !== $this->_page) {
            return $this->_page;
        } else {
            $page = $this->_request->getParam('page');
            if (empty($page)) {
                $page = 1;
            }
            
            $this->_page = $page;
            return $this->_page;
        }
    }

    
    public function getIdentity()
    {
        $identity = Zend_Registry::get('identity');
        
        return $identity;
    }
    
    /**
     * Returns the application configuraition
     * 
     * @return Zend_Config_Xml 
     */
    protected function getAppConfig ()
    {
        if (null !== $this->_appConfig) {
            return $this->_appConfig;
        } else {
            $this->_appConfig = Zend_Registry::get('Application_Config');
            return $this->_appConfig;
        }
    }

    /**
     * Sets the success flash messages
     * 
     * @param string $message
     */
    protected function setFlashSuccess ($message)
    {
        $this->_getFlashMessenger()
            ->setNamespace('success')
            ->addMessage($message);
    }

    /**
     * Sets the flash info messages
     * 
     * @param string $message
     */
    protected function setFlashInfo ($message)
    {
        $this->_getFlashMessenger()
            ->setNamespace('info')
            ->addMessage($message);
    }

    /**
     * Sets the flash error messages
     * 
     * @param string $message
     */
    protected function setFlashError ($message)
    {
        $this->_getFlashMessenger()
            ->setNamespace('error')
            ->addMessage($message);
    }

    /**
     * Returns the Flash Message Helper
     * 
     * @return Zend_View_Abstract FlashMessenger
     */
    private function _getFlashMessenger ()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        }
        
        return $this->_flashMessenger;
    }

    /**
     * sets up flash messenger
     */
    private function _initFlashMessenger ()
    {
        $this->view->error = $this->_getFlashMessenger()
            ->setNamespace('error')
            ->getMessages();
        $this->view->info = $this->_getFlashMessenger()
            ->setNamespace('info')
            ->getMessages();
        $this->view->success = $this->_getFlashMessenger()
            ->setNamespace('success')
            ->getMessages();
        $this->view->warning = $this->_getFlashMessenger()
            ->setNamespace('warning')
            ->getMessages();
    }
}