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
 * @version    $Id: Rule.php 1.0  Jaimie Garner $
 */
class Acl_Model_DbTable_Rule extends Zend_Db_Table_Abstract
{

    /**
     * String
     *
     * @var unknown
     */
    protected $_name = 'acl_rule';

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
                    'CREATE TABLE IF NOT EXISTS `acl_rule` (
              `acl_rule_id` int(11) NOT NULL AUTO_INCREMENT,
              `acl_resource_id` int(11) NOT NULL,
              `acl_role_id` int(11) NOT NULL,
              `acl_type` enum(\'allow\',\'deny\') COLLATE utf8_unicode_ci NOT NULL,
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`acl_rule_id`),
              KEY `fk_acl_rule_acl_resource_idx` (`acl_resource_id`),
              KEY `fk_acl_rule_acl_role1_idx` (`acl_role_id`)
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
        $data = array(
                'acl_rule_id' => 1,
                'acl_resource_id' => 2,
                'acl_role_id' => 1,
                'acl_type' => 'allow'
        );
        $this->insert($data);
        
        $data = array(
                'acl_rule_id' => 2,
                'acl_resource_id' => 5,
                'acl_role_id' => 2,
                'acl_type' => 'allow'
        );
        $this->insert($data);
        $data = array(
                'acl_rule_id' => 4,
                'acl_resource_id' => 7,
                'acl_role_id' => 3,
                'acl_type' => 'allow'
        );
        $this->insert($data);
        
        $data = array(
                'acl_rule_id' => 5,
                'acl_resource_id' => 1,
                'acl_role_id' => 3,
                'acl_type' => 'allow'
        );
        $this->insert($data);
        
        $data = array(
                'acl_rule_id' => 6,
                'acl_resource_id' => 3,
                'acl_role_id' => 3,
                'acl_type' => 'allow'
        );
        $this->insert($data);
        
        $data = array(
                'acl_rule_id' => 7,
                'acl_resource_id' => 4,
                'acl_role_id' => 3,
                'acl_type' => 'allow'
        );
        $this->insert($data);
    }
}