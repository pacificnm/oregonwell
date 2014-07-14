<?php
class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
    public function FlashMessenger()
    {
        $html = '';
        
        // success message
        if(!empty($this->view->success)) {
            $html .= '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Success!</strong> ';
            foreach($this->view->success as $message) {
                $html.= $message;
            }
            $html .='</div>';
        }
        
        // error message
        if(!empty($this->view->error)) {
            $html .='<div class="alert alert-danger alert-dismissable">
            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Error!</strong> ';
            foreach($this->view->error as $message) {
                $html.=$message;
            }
            $html .='</div>';
        }
        
        // warning message
        if(!empty($this->view->warning)) {
            $html .='<div class="alert alert-warning alert-dismissable">
            		<a class="close" data-dismiss="alert" href="#">&times;</a>
					<h4 class="alert-heading">Warning!</h4>';
            foreach($this->view->warning as $message) {
                $html.=$message;
            }
            $html .='</div>';
        }
        
        // info
        if(!empty($this->view->info)) {
            $html .='<div class="alert alert-info alert-dismissable">
            		<a class="close" data-dismiss="alert" href="#">&times;</a>
					<h4 class="alert-heading">Info!</h4>';
            foreach($this->view->warning as $message) {
                $html.=$message;
            }
            $html .='</div>';
        }
        
        $html .='';
        
        
       return $html;
    }
}