<?php

/**
 * MyFlix
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pacificnm.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to pacificnm@gmail.com so we can send you a copy immediately.
 *
 * @category   Install
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Base.php 1.0  Jaimie Garner $
 */
class Install_Model_Base
{

    /**
     * Creates all the tables
     *
     * @param unknown $dbName            
     */
    public function createDatabase ()
    {
        // Acl Tables
        $AclModelDbTableResource = new Acl_Model_DbTable_Resource();
        $AclModelDbTableRole = new Acl_Model_DbTable_Role();
        $AclModelDbTableRule = new Acl_Model_DbTable_Rule();
        
        // auth Tables
        $AuthModelDbTableAuth = new Auth_Model_DbTable_Auth();
        
        // page Tables
        $PageModelDbTablePage = new Page_Model_DbTable_Page();
        $PageModelDbTablePageMeta = new Page_Model_DbTable_Page_Meta();
        
        // navigation Tables
        $NavigationModelDbTableNavigation = new Navigation_Model_DbTable_Navigation();
        
        // email table
        $EmailModelEmail = new Email_Model_Email();
        
        // employee table
        $EmployeeModelEmployee = new Employee_Model_Employee();
       
        
        // navigation table
        $NavigationModelNavigation = new Navigation_Model_Navigation();
        
       
        
        // page
        $PageModelContent = new Page_Model_Content();
        $PageModelPage = new Page_Model_Page();
        
       
       
       // user
       $UserModelUser = new User_Model_User();
       $UserModelUserPassword = new User_Model_User_Password();
       
      
       
    }
}