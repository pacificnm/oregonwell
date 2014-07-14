<?php
class PNM_View_Helper_MainNav
{
    protected $_identity;
    protected $_acl;
    
	public function MainNav()
	{
	    $this->_identity = Zend_Registry::get('identity');
		$this->_acl = new Application_Model_Acl();
	    
				
		echo '
		   <div class="grid_16">
	       <ul class="nav main">';
		        if($this->_acl->isAllowed($this->_identity->acl, Application_Model_Resources::MENU_GUEST)) {
		            
				    echo '<li class="ic-gallery dd"><a href="/index/index" title="Home"><span>Home</span></a></li>';
		        }
		        
		        
		        if($this->_acl->isAllowed($this->_identity->acl, 'menu_employee')) {
				    echo '<li class="ic-form-style"><a href="/client/index" title=""><span>Client</span></a></li>';
				    
		        } else if($this->_acl->isAllowed($this->_identity->acl, 'menu_client')) {
		            echo '<li class="ic-form-style"><a href="/client/view/index" title=""><span>Client</span></a>';
		             echo '<ul>
		                      <li><a href="/client/view/user" title="">Users</a></li>
		                     <li><a href="/workstation/view/client/" title="">Workstations</a></li>
		                      <li><a href="/server/view/client" title="">Servers</a></li>
		                  </ul></li>';
		                     
		        }
		        
		        if($this->_acl->isAllowed($this->_identity->acl, Application_Model_Resources::MENU_EMPLOYEE)) {
    				echo '<li class="ic-dashboard"><a href="/employee/index" title=""><span>Employee</span></a>
    					<ul>
    						<li><a href="/mileage/view/index/" title="">Mileage</a></li>
    						<li><a href="/task/view/employee/id/" "">Tasks</a></li>
    						<li><a href="" title="">Workorders</a></li>
    					</ul>
    				</li>';		
		        }
		        
		        if($this->_acl->isAllowed($this->_identity->acl, Application_Model_Resources::MENU_ADMIN)) {
				    echo '<li class="ic-charts"><a href="/admin/index" title=""><span>Admin</span></a>
				           <ul> 
				                <li><a href="/admin/page/index">Static Pages</a></li>
				                <li><a href="">Company</a></li>
				            <li><a href="">Employees</a></li>
				            <li><a href="/admin/module/index">Modules</a></li>
				            </ul>
				           </li>';
		        }
		echo '
			</ul>
        </div>
        <div class="clear"></div>';
		
		
		
		
	}
}