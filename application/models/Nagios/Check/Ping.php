<?php
class Application_Model_Nagios_Check_Ping extends Application_Model_Nagios_Nagios
{
	
	public function __construct()
	{
		
	}
	
	
	public static function check($host)
	{
		$query = "GET services\nColumns: host_name description last_check last_hard_state_change state plugin_output\nFilter: host_name = {$host}\n";
		
		$result = Application_Model_Nagios_Nagios::getInstance()->query($query);
		
		
		Zend_Debug::dump(Zend_Json::encode($result));
		
		return $result;
	}
}