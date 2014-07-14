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
 * @version    $Id: Resource.php 1.0  Jaimie Garner $
 */
class Acl_Model_DbTable_Resource extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var string
     */
    protected $_name = 'acl_resource';

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
                    'CREATE TABLE IF NOT EXISTS `acl_resource` (
              `acl_resource_id` int(11) NOT NULL AUTO_INCREMENT,
              `acl_resource_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `acl_resource_display` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`acl_resource_id`)
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
        // create
        $data = array(
                'acl_resource_id' => '1',
                'acl_resource_name' => 'create',
                'acl_resource_display' => 'Create'
        );
        $this->insert($data);
        
        // read
        $data = array(
                'acl_resource_id' => '2',
                'acl_resource_name' => 'read',
                'acl_resource_display' => 'Read'
        );
        $this->insert($data);
        
        // update
        $data = array(
                'acl_resource_id' => '3',
                'acl_resource_name' => 'update',
                'acl_resource_display' => 'Update'
        );
        $this->insert($data);
        
        // delete
        $data = array(
                'acl_resource_id' => '4',
                'acl_resource_name' => 'delete',
                'acl_resource_display' => 'Delete'
        );
        $this->insert($data);
        
        // member
        $data = array(
                'acl_resource_id' => '5',
                'acl_resource_name' => 'member',
                'acl_resource_display' => 'Member'
        );
        $this->insert($data);
        
        // admin
        $data = array(
                'acl_resource_id' => '7',
                'acl_resource_name' => 'admin',
                'acl_resource_display' => 'Admin'
        );
        $this->insert($data);
    }
}