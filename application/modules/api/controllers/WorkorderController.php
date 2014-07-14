<?php

class Api_WorkorderController extends Api_Model_Controller {
  
  public function init() {
    parent::init();
    $this->_helper->layout->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    
  }
  
  
  public function indexAction()
  {
    
  }
  
  public function activeAction()
  {
    
  }
  
  public function clientAction()
  {
    
  }
  
}
