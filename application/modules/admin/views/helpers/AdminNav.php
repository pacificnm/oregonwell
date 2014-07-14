<?php
class Admin_View_Helper_AdminNav extends Application_Model_View_Helper
{
    public function AdminNav()
    {
        $html = '<div class="well well-sm">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="" data-toggle="modal" data-target="#myModal">' . $this->translate('Help') . '</a></li>
				<li><a href="/auth/admin">'. $this->translate('Accounts') .'</a></li>
                <li><a href="/movie/scan/index">'.$this->translate('Scan Movies').'</a></li>
				<li';
        $html .='</ul>
		</div>';

        return $html;
    }


    
}