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
 * @category   Acl
 * @package    Model
 * @subpackage DbTable
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Role.php 1.0  Jaimie Garner $
 */
class Acl_Model_DbTable_Role extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var String
     */
    protected $_name = 'acl_role';

    /**
     * Contructor
     */
    public function __construct ()
    {
        parent::__construct();
        
        $this->verify();
    }

    /**
     * Verifies the Database Table Exists
     *
     * @throws Zend_Exception
     */
    private function verify ()
    {
        // test if Database exists
        try {
            $db = $this->getDefaultAdapter();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
        
        // test if table exists
        try {
            $result = $db->describeTable($this->_name);
            
            if (empty($result)) {
                $this->createTable();
                $this->insertRows();
            }
        } catch (Exception $e) {
            $this->createTable();
            $this->insertRows();
        }
    }

    /**
     * Creates the Database Table
     *
     * @throws Zend_Exception
     */
    private function createTable ()
    {
        $db = $this->getDefaultAdapter();
        
        try {
            $db->query(
                    'CREATE TABLE IF NOT EXISTS `acl_role` (
              `acl_role_id` int(11) NOT NULL AUTO_INCREMENT,
              `acl_role_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `acl_role_display` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `acl_role_child` int(11) NOT NULL DEFAULT \'0\',
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`acl_role_id`)
            ) ENGINE=InnoDB');
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Inserts default rows in the table
     */
    private function insertRows ()
    {
        
        // guest
        $data = array(
                'acl_role_id' => 1,
                'acl_role_name' => 'guest',
                'acl_role_display' => 'Guest',
                'acl_role_child' => 0
        );
        $this->insert($data);
        
        // member
        $data = array(
                'acl_role_id' => 2,
                'acl_role_name' => 'member',
                'acl_role_display' => 'Member',
                'acl_role_child' => 1
        );
        $this->insert($data);
        
        // admin
        $data = array(
                'acl_role_id' => 3,
                'acl_role_name' => 'admin',
                'acl_role_display' => 'Admin',
                'acl_role_child' => 2
        );
        $this->insert($data);
    }
}