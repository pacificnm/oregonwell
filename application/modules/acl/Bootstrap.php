<?php
class Acl_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initViewHelpers()
    {
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
    
        $view->setHelperPath(APPLICATION_PATH . '/modules/acl/views/helpers', 
                'Acl_View_Helper');
    
    }

}