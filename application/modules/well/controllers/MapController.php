<?php
class Well_MapController extends Well_Model_Controller_Well
{

    public function init ()
    {
        parent::init();

       
    }
    
    public function indexAction()
    {
        $this->view->id = $this->getParam('id');
    }
}