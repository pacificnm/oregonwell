<?php
class Search_Bootstrap extends Zend_Application_Module_Bootstrap 
{
    
    protected function _initViewHelpers()
    {
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
        
        $view->setHelperPath(APPLICATION_PATH . '/modules/movie/views/scripts/helpers', 'Movie_View_Helper');
    }
}