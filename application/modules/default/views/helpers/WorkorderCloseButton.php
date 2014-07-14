<?php
class Default_View_Helper_WorkorderCloseButton extends Application_Model_View_Helper
{
    public function WorkorderCloseButton($url)
    {
        $html ='<a href="/workorder/update/close/'.$url.'" type="button" class="btn btn-danger btn-xs"
	               data-toggle="tooltip" data-placement="top" title="'.$this->translate('Close Out Workorder').'">
	               <i class="glyphicon glyphicon-remove-sign"></i>
	           </a>';

        return $html;
    }
}