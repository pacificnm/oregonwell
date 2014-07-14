<?php
class Default_View_Helper_GetAcl extends Zend_View_Helper_Action
{
    public function GetAcl()
    {
        return Zend_Registry::get('Zend_Acl');
    }
}