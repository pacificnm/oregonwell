<?php
class Zend_View_Helper_PageTitle extends Zend_View_Helper_Action
{
    public function PageTitle()
    {
        
        // load page
        $PageModelPage = new Page_Model_Page();
        
        
        return;
    }
    
    private function _getRequest()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        
        return $request;
    }
}
