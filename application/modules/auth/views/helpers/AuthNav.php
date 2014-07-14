<?php
class Auth_View_Helper_AuthNav extends Zend_View_Helper_Abstract
{
    public function AuthNav()
    {
        $html = '
                <div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">Help</a></li>
				<li ';
        if($this->getPage() == 'index') $html .=' class="active"';
        $html .='><a href="/auth/admin">Accounts</a></li>

				<li';
        if($this->getPage() == 'create') $html .=' class="active"';
        $html .='><a href="/auth/admin/create">Create Account</a></li>';

        if($this->getPage() == 'view') {
            $html .= '<li class="active"><a href="#">View Account</a></li>';
        }

        if($this->getPage() == 'delete') {
            $html .= '<li class="active"><a href="#">Delete Account</a></li>';
        }
                
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