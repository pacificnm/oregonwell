<?php
class Default_View_Helper_WorkorderTimeButton extends Application_Model_View_Helper
{
    public function WorkorderTimeButton($url)
    {
        $html ='<a href="/workorder/create/time/'.$url.'" type="button" class="btn btn-success btn-xs"
	               data-toggle="tooltip" data-placement="top" title="'.$this->translate('Add Time To Workorder').'">
	               <i class="glyphicon glyphicon-import"></i>
	           </a>';

        return $html;
    }
}