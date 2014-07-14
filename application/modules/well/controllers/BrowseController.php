<?php
class Well_BrowseController extends Well_Model_Controller_Well
{

    public function init ()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $this->view->getModuleName = $this->getRequest()->getModuleName();
        $this->view->getControllerName = $this->getRequest()->getControllerName();
        $this->view->getActionName = $this->getRequest()->getActionName();
        
        $html = '<button class="btn btn-primary  pull-right" data-toggle="modal" data-target="#helpBrowse"><i class="fa fa-question-circle fa-fw"></i> Help</button><div class="clear-fix"></div>';
        
        $this->view->pageTitle = $this->view->pageTitle . $html;
    }
}