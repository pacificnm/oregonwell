<?php
class Default_View_Helper_UpdateButton extends Zend_View_Helper_Action
{
    public function UpdateButton($url, $title)
    {
        $html ='<a href="'.$url.'" type="button" class="btn btn-warning btn-xs"
	               data-toggle="tooltip" data-placement="top" title="'.$title.'">
	               <i class="glyphicon glyphicon-pencil"></i>
	           </a>';

        return $html;
    }
}