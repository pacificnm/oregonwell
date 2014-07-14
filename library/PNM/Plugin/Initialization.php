<?php

class PNM_Plugin_Initialization extends Zend_Controller_Plugin_Abstract
{

    
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
    	
    
    	
        $front = Zend_Controller_Front::getInstance();
     
                // set view
        $view = $front->getInstance()
            ->getParam('bootstrap')
            ->getResource('view');
    
        
        
        
        
        
        
        // set up models and controllers
        $requestModule = $front->getRequest()->getModuleName();
        $requestController = $front->getRequest()->getControllerName();
        $requestAction = $front->getRequest()->getActionName();
		
    }
}