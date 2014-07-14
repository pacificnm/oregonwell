<?php

class Api_Model_Client {

  private $_clientModel = null;

  

  public function all($key) {
    
     $clients = $this->_getClientModel()->findAll();

    return $clients->toArray();
  }

  public function id($id, $key) {
    
    $client = $this->_getClientModel()->findById($id);
    
    return $client->toArray();
  }
  
  /**
   * 
   * @return Client_Model_Client
   */
  private function _getClientModel() {
    if (null !== $this->_clientModel) {
      return $this->_clientModel;
    }
    else {
      $this->_clientModel = new Client_Model_Client();
      return $this->_clientModel;
    }
  }

}
