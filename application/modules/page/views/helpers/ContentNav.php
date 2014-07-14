<?php
class Page_View_Helper_ContentNav extends Application_Model_View_Helper
{
    public function ContentNav()
    {
        $name = $this->getRequest()->getParam('name');
        
        $html ='
                <div class="well well-sm">
                <ul class="nav nav-pills nav-stacked" role="navigation">
                    
                    <li';
                    if($name == 'it-service') $html .= ' class="active" ';
					$html .='><a href="/page/content/it-service" title="Comercial Services provided by Pacific Network Management in the Grants Pass Area">Comercial Services</a></li>';
					
					$html .='<li';
					if($name == 'managed-it-services') $html .= ' class="active" ';
					$html .='><a href="/page/content/managed-it-services" title="Managed IT Services provided by Pacific Network Management in the Grants Pass Area">Managed IT Services</a></li>';
					
					
					$html .='<li';
                    if($name == 'network-support') $html .= ' class="active" ';
					$html .='><a href="/page/content/network-support" title="Network Support services provided by Pacific Network Management in the Grants Pass Area">Network Support</a></li>';
					
					
					$html .='<li';
					if($name == 'hosted-exchange') $html .= ' class="active" ';
					$html .='><a href="/page/content/hosted-exchange" title="Microsoft Exchange services provided by Pacific Network Management in the Grants Pass Area">Microsoft Exchange</a></li>';
					
					
					$html .='<li';
					if($name == 'network-security') $html .= ' class="active" ';
					$html .='><a href="/page/content/network-security" title="Network Security services provided by Pacific Network Management in the Grants Pass Area">Network Security</a></li>';
					
					
					
					$html .='<li';
					if($name == 'online-backup') $html .= ' class="active" ';
					$html .='><a href="/page/content/online-backup" title="Backup Solutions services provided by Pacific Network Management in the Grants Pass Area">Backup Solutions</a></li>';
					
					
					$html .='<li';
					if($name == 'data-recovery') $html .= ' class="active" ';
					$html .='><a href="/page/content/data-recovery" title="Data Recovery services provided by Pacific Network Management in the Grants Pass Area">Data Recovery</a></li>';
					
					/**
					$html .='<li';
					if($name == 'remote-support') $html .= ' class="active" ';
					$html .='><a href="/page/content/remote-support">Remote IT Support</a></li>';
					
					
					$html .='<li';
					if($name == 'mobile-support') $html .= ' class="active" ';
					$html .='><a href="/page/content/mobile-support">Mobile Device Support</a></li>';
					
					$html .='<li';
                    if($name == 'content-filtering') $html .= ' class="active" ';
                    $html .='><a href="/page/content/content-filtering">Content Filtering</a></li>';
                    
                    $html .='<li';
                    if($name == 'it-consulting') $html .= ' class="active" ';
                    $html .='><a href="/page/content/it-consulting">IT Consulting</a></li>';
                    
                    $html .='<li';
                    if($name == 'backup-solutions') $html .= ' class="active" ';
                    $html .='><a href="/page/content/backup-solutions">Backup Solutions</a></li>';
				    */
					
				$html .='</ul>
                </div>';
        return $html;
    }
}