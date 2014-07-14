<?php
class Default_View_Helper_getIdentity extends Zend_View_Helper_Action
{
    public function getIdentity()
    {
        
        
        return Zend_Registry::get('identity');
    }
}