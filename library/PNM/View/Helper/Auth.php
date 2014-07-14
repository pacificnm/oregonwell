<?php
class PNM_View_Helper_Auth extends Zend_View_Helper_Abstract
{
	public function auth()
	{
		$auth = Zend_Auth::getInstance();
		
		return $auth;
	}
}