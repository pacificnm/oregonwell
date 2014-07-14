<?php
abstract class PNM_Controller_Action extends Zend_Controller_Action
{
    protected $_flashMessenger;
    protected $_identity;
    protected $_translate;
    protected $_acl;
    
    public function init()
    {
    	
        Zend_Debug::dump($this->getAllParams());
        
    	$requestModule     = $this->getParam('module');
    	$requestController = $this->getParam('controller');
    	$requestAction     = $this->getParam('action');
    	
    	$appConfig = Zend_Registry::get('appConfig');
    	
 
    	
    	// setup identity
        $Auth = Zend_Auth::getInstance();
        $this->_identity = $Auth->getIdentity();
        $this->view->identity = $Auth->getIdentity();

        // setup acl
        $this->_acl = Zend_Registry::get('appAcl');
        $this->view->acl = Zend_Registry::get('appAcl');

        // setup flash messenger
        $this->view->error = $this->_getFlashMessenger()->setNamespace('error')->getMessages();
        $this->view->success = $this->_getFlashMessenger()->setNamespace('success')->getMessages();
        $this->view->warning = $this->_getFlashMessenger()->setNamespace('warning')->getMessages();

        // check acl
       // $actionAcl = $mocuelConfig->module->{$requestModule}->controllers->{$requestController}->actions->{$requestAction}->acl;
        
        // check acl
        /**
        if(!$this->_acl->isAllowed($this->_identity->role, $actionAcl)) {
        	$this->_getFlashMessenger()
        	->setNamespace('error')
        	->addMessage('Access Denied. Please sign in with an account has has access to the resource you requested.');
        	//$this->_redirect('/auth/signin');
        }
        */
        // setup bread crumbs
        $this->_initNavigation();
       
    }
    
    protected function _getFlashMessenger()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        }
    
        return $this->_flashMessenger;
    }
    
    protected function _initNavigation()
    {
        //$config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/breadcrumb.xml','navigation');
        $config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml','navigation');
        $nav = new Zend_Navigation($config);
         
        $this->view->navigation($nav);
    
        //$this->view->navigation()->setAcl($this->getAppAcl())->setRole($this->getAuthIdentity()->role);
    
        Zend_Registry::set('Zend_Navigation', 	$nav);
    }
    
}