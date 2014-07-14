<?php
class Default_View_Helper_getAcl extends Zend_View_Helper_Action
{
    public function getAcl()
    {
        return Zend_Registry::get('Zend_Acl');
    }
}