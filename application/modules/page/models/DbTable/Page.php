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
 * @category   Page
 * @package    Model
 * @subpackage DbTable
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Page.php 1.0  Jaimie Garner $
 */
class Page_Model_DbTable_Page extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'page';

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
            $db->query( "
              CREATE TABLE IF NOT EXISTS `page` (
              `page_id` int(20) NOT NULL AUTO_INCREMENT,
              `route` varchar(100) NOT NULL,
              `module` varchar(100) NOT NULL,
              `controller` varchar(100) NOT NULL,
              `action` varchar(100) NOT NULL,
              `acl_resource_id` int(11) NOT NULL,
              `breadcrumb` int(3) NOT NULL DEFAULT '1',
              `cache` int(3) NOT NULL DEFAULT '0',
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`page_id`),
              KEY `fk_page_acl_resource1_idx` (`acl_resource_id`)
            ) ENGINE=InnoDB;
                    ");
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Inserts default rows in the table
     */
    private function insertRows ()
    {
        $db = $this->getDefaultAdapter();
        $db->query("
              INSERT INTO `page` (`page_id`, `route`, `module`, `controller`, `action`, `acl_resource_id`, `breadcrumb`, `cache`, `modified`) VALUES
            (1, 'default', 'admin', 'index', 'index', 7, 1, 0, '2013-12-13 06:15:07'),
            (2, 'default', 'acl', 'index', 'index', 7, 1, 0, '2013-12-13 06:17:59'),
            (3, 'default', 'auth', 'index', 'index', 7, 1, 0, '2013-12-13 06:18:34'),
            (4, 'default', 'config', 'index', 'update', 7, 1, 0, '2013-12-13 08:34:40'),
            (5, 'default', 'language', 'index', 'index', 7, 1, 0, '2013-12-13 06:19:00'),
            (6, 'default', 'navigation', 'index', 'index', 2, 1, 0, '2013-12-13 06:19:43'),
            (7, 'default', 'page', 'index', 'index', 7, 1, 0, '2013-12-13 06:20:05'),
            (8, 'default', 'search', 'index', 'index', 2, 1, 0, '2013-12-13 06:20:18'),
            (9, 'default', 'page', 'create', 'page', 7, 1, 0, '2013-12-13 08:25:37'),
            (10, 'default', 'page', 'view', 'index', 7, 1, 0, '2013-12-13 08:26:40'),
            (11, 'default', 'page', 'create', 'module', 7, 1, 0, '2013-12-13 08:29:47'),
            (12, 'default', 'auth', 'admin', 'index', 1, 1, 0, '2013-12-13 08:32:39'),
            (13, 'default', 'config', 'index', 'index', 7, 1, 0, '2013-12-13 08:33:31'),
            (14, 'default', 'auth', 'admin', 'view', 7, 1, 0, '2013-12-13 08:36:32'),
            (15, 'default', 'auth', 'admin', 'update', 7, 1, 0, '2013-12-13 08:37:28'),
            (16, 'default', 'auth', 'admin', 'delete', 7, 1, 0, '2013-12-13 08:38:54'),
            (17, 'default', 'auth', 'admin', 'create', 7, 1, 0, '2013-12-13 08:39:48'),
            (18, 'default', 'page', 'update', 'page', 7, 1, 0, '2013-12-13 19:19:25'),
            (19, 'default', 'page', 'delete', 'page', 7, 1, 0, '2013-12-13 19:25:44'),
            (20, 'default', 'page', 'view', 'meta', 7, 1, 0, '2013-12-14 07:19:05'),
            (21, 'default', 'page', 'update', 'meta', 7, 1, 0, '2013-12-14 08:10:19'),
            (22, 'default', 'cache', 'index', 'index', 7, 1, 0, '2013-12-17 01:54:30'),
            (23, 'default', 'cache', 'index', 'clean', 7, 1, 0, '2013-12-17 01:55:12'),
            (24, 'default', 'cache', 'index', 'rebuild', 7, 1, 0, '2013-12-17 01:55:53'),
            (25, 'default', 'search', 'admin', 'index', 7, 1, 0, '2013-12-17 01:56:54'),
            (26, 'default', 'search', 'admin', 'rebuild', 7, 1, 0, '2013-12-17 01:57:37'),
            (27, 'default', 'log', 'index', 'index', 7, 1, 0, '2013-12-17 01:58:26'),
            (28, 'default', 'log', 'index', 'clear', 7, 1, 0, '2013-12-17 01:59:11'),
            (29, 'default', 'navigation', 'index', 'import', 7, 1, 0, '2013-12-17 02:01:56'),
            (30, 'default', 'development', 'index', 'index', 7, 1, 0, '2013-12-17 02:03:02'),
            (31, 'default', 'acl', 'update', 'role', 7, 1, 0, '2013-12-17 02:54:29'),
            (32, 'default', 'acl', 'delete', 'role', 7, 1, 0, '2013-12-17 02:55:02'),
            (33, 'default', 'acl', 'update', 'resource', 7, 1, 0, '2013-12-17 03:50:22'),
            (34, 'default', 'acl', 'delete', 'resource', 7, 1, 0, '2013-12-17 03:51:12'),
            (35, 'default', 'acl', 'update', 'rule', 7, 1, 0, '2013-12-17 03:56:36'),
            (36, 'default', 'acl', 'delete', 'rule', 7, 1, 0, '2013-12-17 03:58:15')");
        
        try {} catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
}