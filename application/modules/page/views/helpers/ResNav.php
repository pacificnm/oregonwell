<?php
class Page_View_Helper_ResNav extends Application_Model_View_Helper
{
    public function ResNav()
    {
        $name = $this->getRequest()->getParam('name');

        $html ='
        <div class="well well-sm">
        <ul class="nav nav-pills nav-stacked" role="navigation">';
        
        $html .='<li';
        if($name == 'onsite-support') $html .= ' class="active" ';
        $html .='><a href="/page/content/onsite-support">Onsite Support</a></li>';
        
        $html .='<li';
        if($name == 'virus-removal') $html .= ' class="active" ';
        $html .='><a href="/page/content/virus-removal">Virus Removal</a></li>';
        
        
        $html .='<li';
        if($name == 'wireless-networking') $html .= ' class="active" ';
        $html .='><a href="/page/content/wireless-networking">Wireless Networking</a></li>';
        
        
        $html .='<li';
        if($name == 'desktop-installations') $html .= ' class="active" ';
        $html .='><a href="/page/content/desktop-installations">Desktop Installations</a></li>';
        
        
        $html .='<li';
        if($name == 'internet-connection') $html .= ' class="active" ';
        $html .='><a href="/page/content/internet-connection">Internet Troubleshooting</a></li>';
        
       
        $html .='</ul>
                </div>';
        return $html;
        
        
        
        
        $html .='<li';
        if($name == 'hardware-support') $html .= ' class="active" ';
        $html .='><a href="/page/content/hardware-support">Hardware Support</a></li>';
        
       
        
        
        
        $html .='<li';
        if($name == 'software-instalations') $html .= ' class="active" ';
        $html .='><a href="/page/content/software-instalations">Software Support</a></li>';
        
        $html .='<li';
        if($name == 'remote-access') $html .= ' class="active" ';
        $html .='><a href="/page/content/remote-access">Remote Access</a></li>';
        
        $html .='<li';
        if($name == 'data-cable') $html .= ' class="active" ';
        $html .='><a href="/page/content/data-cable">Cable Installation</a></li>';
        
        
        $html .='<li';
        if($name == 'google-apps') $html .= ' class="active" ';
        $html .='><a href="/page/content/google-apps">Google Apps</a></li>';
        
        $html .='<li';
        if($name == 'virtualization') $html .= ' class="active" ';
        $html .='><a href="/page/content/virtualization">Virtualization</a></li>';
    }
}














