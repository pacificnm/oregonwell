<?php
class Api_Model_Controller extends Application_Model_Controller
{
  private $_clientModel = null;
  
  /**
   * 
   * @return Client_Model_Client
   */
  public function getClientModel() {
    if (null !== $this->_clientModel) {
      return $this->_clientModel;
    }
    else {
      $this->_clientModel = new Client_Model_Client();
      return $this->_clientModel;
    }
  }
}

