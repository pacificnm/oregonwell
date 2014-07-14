<?php
class Application_Model_Nagios_Nagios
{
	private $_scoketPath =   '/var/run/nagios/live';
	
	private $_socket = null;
	
	private $_status = null;
	
	public function __construct()
	{
		
	}
	
	
	public function getColumns()
	{
		$query = "GET columns\nColumns: table name type \n";
		
		$result = $this->query($query);
		
		Zend_Debug::dump($result);
		
		return $result;
	}
	
	public function getCommands()
	{
		$query = "GET commands\nColumns: name\n";
		
		$result = $this->query($query);
		
		$array = Zend_Json::decode($result);

		return $array;
	}
	
	public function getServices($host, $command = null)
	{
		$query = "GET services\nColumns: host_name description last_check last_hard_state_change state state_type plugin_output \nFilter: host_name = {$host}\n";
		
		if($command != null) {
			$query .= "Filter: description = {$command}\n";
		}
		//
		
		
		$result = $this->query($query);
		
		$array = Zend_Json::decode($result);

		return $array;
	}
	
	
	public function getLog($host = null, $limit=15)
	{
		$query = "GET log\nColumns: time host_name type state_type plugin_output command_name contact_name current_contact_email\nFilter: host_name = {$host}\nLimit: {$limit}\n";
		//
		$result = $this->query($query);
		
		$array = Zend_Json::decode($result);
		
		return $array;
	}

	
	public function query($query)
	{
		$offset = 0;
		$socketData = '';
		
		
		$result = socket_connect($this->getSocket(), $this->_scoketPath);
		
		socket_write($this->getSocket(), $query . "OutputFormat:json\nResponseHeader: fixed16\n\n");
		
		$read = $this->readSocket(16);
	
		if($read === false) {
			throw new Zend_Exception(socket_strerror(socket_last_error($this->getSocket())));
		}
		
		$status = substr($read, 0, 3);

		
		// Extract content length
		$len = intval(trim(substr($read, 4, 11)));
		
		// Read socket until end of data
		$read = $this->readSocket($len);
		
		$this->closeSocket();
		
		return $read;
	}
	
	public  function readSocket($len) 
	{
		
		$offset = 0;
		$socketData = '';
	
		while($offset < $len) {
			if(($data = @socket_read($this->getSocket(), $len - $offset)) === false)
				return false;
	
			$dataLen = strlen ($data);
			$offset += $dataLen;
			$socketData .= $data;
	
			if($dataLen == 0)
				break;
		}
	
		return $socketData;
	}
	
	
	public function closeSocket()
	{
		socket_close($this->getSocket());
		$this->_socket = null;
	}
	
	public function getSocket()
	{
		if (null !== $this->_socket) {
			return $this->_socket;
		} else {
			$socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
			$this->_socket = $socket;
			return $this->_socket;
		}
	}

	
	public function getStatus()
	{
		
	}
	
	public function setStatus($status)
	{
		
	}
}