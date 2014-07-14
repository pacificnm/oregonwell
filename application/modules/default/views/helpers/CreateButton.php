<?php
class Default_View_Helper_CreateButton extends Zend_View_Helper_Action
{
    public function CreateButton($url, $title)
    {
        $html ='<a href="'.$url.'" type="button" class="btn btn-success btn-xs" 
	               data-toggle="tooltip" data-placement="top" title="'.$title.'">
	               <i class="glyphicon glyphicon-plus"></i>
	           </a>';
        
        return $html;
    }
}