<?php
class Config_View_Helper_ConfigNav extends Zend_View_Helper_Abstract
{
    public function ConfigNav()
    {
        $html = '
                <div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">Help</a></li>
				<li ';
        if($this->getPage() == 'index') $html .=' class="active"';
        $html .='><a href="/config/index">View Configuration</a></li>

				<li';
        if($this->getPage() == 'update') $html .= ' class="active" ';
        
        $html .='><a href="/config/index/update">Update Configuration</a></li>';
        
        $html .='</ul>
		</div>';

        return $html;
    }


    private function getPage()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        
        $module = $request->getParam('module');
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');
        
        return $action;
    }
}