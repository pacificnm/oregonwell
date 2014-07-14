<?php

class Application_Model_Api_Client {

  private $_clientModel = null;

  /**
   * Gets all clients that are active
   * @return array
   */
  public function all() {
    $clients = $this->_getClientModel()->findAll();

    return array('result', $clients->toArray());
  }

  /**
   * gets a single client by id
   * @param int $id
   * @return array
   */
  public function get($id) {
    $client = $this->_getClientModel()->findById($id);

    return array('result', $client->toArray());
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
