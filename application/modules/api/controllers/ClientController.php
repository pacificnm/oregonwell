<?php

class Api_ClientController extends Api_Model_Controller {
  
  public function init() {
    parent::init();
    $this->_helper->layout->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    
  }
  
  public function indexAction()
  {
    
  }
  
  public function allAction()
  {
    $clients = $this->getClientModel()->findAll();
    
    echo Zend_Json::encode($clients);
  }
  
  public function viewAction()
  {
    $clientId = $this->getParam("client_id");
    
    $client = $this->getClientModel()->load($clientId);
    
    echo Zend_Json::encode($client);
  }
  
}
