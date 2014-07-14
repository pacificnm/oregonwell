<?php
class Zend_View_Helper_WellNav extends Application_Model_View_Helper
{

    public function WellNav ()
    {
        
        $active = "/". $this->getRequest()->getModuleName() ."/". $this->getRequest()->getControllerName()."/".$this->getRequest()->getActionName();
        $id = $this->getRequest()->getParam('id', 0);
        
        
        $html = '
        <section id="navTabs">
        <div class="row">
        <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist" style="border-bottom: 0px">
        <li '; 
        if($active == "/well/browse/index") { $html .='class="active"'; } 
        $html .= '><a href="/well/browse">Browse</a></li>
        <li '; 
        if($active == "/well/search/index") { $html .= 'class="active"'; }
        $html .= '><a href="/well/search">Advanced Search</a></li>';
        
               
        if($id > 0 ) {
            $html .='<li '; 
            if($active == "/well/view/index") { $html .='class="active"'; } 
            $html .= '><a href="/well/view/index/id/'.$id.'">Well Data</a></li>
            <li '; 
            if($active == "/well/map/index") { $html .= 'class="active"'; } 
            $html .='><a href="/well/map/index/id/'.$id.'">vicinity Data</a></li>';
        }
               
        
        if($this->getIdentity()->auth_id == 0) {
            $html .='<li ';
            $html .='><a href="/register">Register</a></li>';
            
        } else {
        
            $html .= '<li '; 
            if($active == "/profile/") { $html .= 'class="active"'; }
            $html .='><a href="/profile">My Profile</a></li>';
        }     
            $html .='</ul>
                </div>
            </div>
        </section>';
        
        echo $html;
    }
}