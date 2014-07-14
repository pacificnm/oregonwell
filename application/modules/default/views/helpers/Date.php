<?php
class Default_View_Helper_Date extends Zend_View_Helper_Action
{
    public function Date($date)
    {
        $date = new Zend_Date($date, null, 'en_US');
        
        return $date;
    }
}