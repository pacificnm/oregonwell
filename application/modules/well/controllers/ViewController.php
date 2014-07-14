<?php
class Well_ViewController extends Well_Model_Controller_Well
{

    public function init ()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->view->id = $this->getParam('id', 0);
        
        // set viewed
        
        $html = '<button class="btn btn-primary  pull-right" data-toggle="modal" data-target="#helpBrowse"><i class="fa fa-question-circle fa-fw"></i> Help</button><div class="clear-fix"></div>';
        
        $this->view->pageTitle = $this->view->pageTitle . $html;
    }
}