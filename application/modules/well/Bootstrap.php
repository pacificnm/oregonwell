<?php
class Well_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initViewHelpers()
    {
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
    
        $view->setHelperPath(APPLICATION_PATH . '/modules/well/views/helpers',
                'Well_View_Helper');
    
    }

}