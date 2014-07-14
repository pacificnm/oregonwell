<?php
class Default_View_Helper_GetIdentity extends Zend_View_Helper_Action
{
    public function GetIdentity()
    {
        
        
        return Zend_Registry::get('identity');
    }
}