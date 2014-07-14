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
 * @category   Auth
 * @package    Model
 * @subpackage DbTable
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Auth.php 1.0  Jaimie Garner $
 */
class Auth_Model_DbTable_Auth extends Zend_Db_Table_Abstract
{
    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'auth';
    
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
            $db->query('CREATE TABLE IF NOT EXISTS `auth` (
              `auth_id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(100) NOT NULL,
              `email` varchar(200) NOT NULL,
              `password` varchar(100) NOT NULL,
              `name` varchar(100) NOT NULL,
              `acl_role_id` int(11) NOT NULL,
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`auth_id`),
              KEY `acl_role_id` (`acl_role_id`) USING BTREE
            ) ENGINE=InnoDB ');
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
    
    /**
     * Inserts default rows in the table
     */
    private function insertRows ()
    {
        
    }
}