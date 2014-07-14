<?php
class Application_Model_View_Helper extends Zend_View_Helper_Abstract
{
    /**
     * Gets the Request Object
     *
     * @return Zend_Controller_Request_Abstract
     */
    public function getRequest ()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        return $request;
    }

    /**
     * 
     * @param string $string
     * @return string
     */
    public function translate($string)
    {
        $translate = Zend_Registry::get('Zend_Translate');

        $string = (string)$translate->translate($string);

        return $string;
    }
    
    public function getAcl()
    {
        return Zend_Registry::get('Zend_Acl');
    }
    
    public function getIdentity()
    {
        return Zend_Registry::get('identity');
    }
}