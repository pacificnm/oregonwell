<?php
class Default_View_Helper_WorkorderNoteButton extends Application_Model_View_Helper
{
    public function WorkorderNoteButton($url)
    {
        $html ='<a href="/workorder/create/note/'.$url.'" type="button" class="btn btn-success btn-xs"
	               data-toggle="tooltip" data-placement="top" title="'.$this->translate('Add Note To Workorder').'">
	               <i class="glyphicon glyphicon-book"></i>
	           </a>';

        return $html;
    }
}