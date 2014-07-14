<?php
class Default_View_Helper_DeleteButton extends Zend_View_Helper_Action
{
    public function DeleteButton($url, $title)
    {
        $html ='<a href="'.$url.'" type="button" class="btn btn-danger btn-xs"
	               data-toggle="tooltip" data-placement="top" title="'.$title.'">
	               <i class="glyphicon glyphicon-remove"></i>
	           </a>';

        return $html;
    }
}