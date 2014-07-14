<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap 
{
	protected function _initViewHelpers()
	{
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();
	
		$view->addHelperPath(APPLICATION_PATH . '/modules/vendor/views/helpers',
				'Vendor_View_Helper');
	
	}
   
}