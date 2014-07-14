<?php

class Api_GetController extends Api_Model_Controller {

  private $_server = null;
  private $_apiKey = null;

  public function init() {
    parent::init();
    $this->_helper->layout->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);

    $this->_server = new Zend_Json_Server();
  }

  public function indexAction() {

    $this->_server->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);
    $this->_server->setClass('Registration');
    echo $this->_server->handle();
  }

  public function clientAction() {
    $this->_server->setClass('Api_Model_Client');

    if ('GET' == $_SERVER['REQUEST_METHOD']) {
      // Indicate the URL endpoint, and the JSON-RPC version used:
      $this->_server->setTarget('/api/get/client')
          ->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);

      // Grab the SMD
      $smd = $this->_server->getServiceMap();

      // Return the SMD to the client
      header('Content-Type: application/json');
      echo $smd;
      return;
    }
        
    $this->_server->handle();
  }

  public function workorderAction() {
    $this->_server->setClass('Api_Model_Workorder');

    if ('GET' == $_SERVER['REQUEST_METHOD']) {
      // Indicate the URL endpoint, and the JSON-RPC version used:
      $this->_server->setTarget('/api/get/workorder')
          ->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);

      // Grab the SMD
      $smd = $this->_server->getServiceMap();

      // Return the SMD to the client
      header('Content-Type: application/json');
      echo $smd;
      return;
    }
    $this->_server->handle();
  }

}
