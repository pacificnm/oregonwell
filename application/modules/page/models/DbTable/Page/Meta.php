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
 * @subpackage DbTable_Page
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Meta.php 1.0  Jaimie Garner $
 */
class Page_Model_DbTable_Page_Meta extends Zend_Db_Table_Abstract
{
    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'page_meta';
    
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
            $db->query('CREATE TABLE IF NOT EXISTS `page_meta` (
              `page_meta_id` int(11) NOT NULL AUTO_INCREMENT,
              `page_id` int(11) DEFAULT NULL,
              `page_title` varchar(255) DEFAULT NULL,
              `meta_title` varchar(255) DEFAULT NULL,
              `meta_description` text,
              `meta_keyword` text,
              `language` varchar(45) DEFAULT NULL,
              `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`page_meta_id`),
              KEY `fk_page_meta_page1_idx` (`page_id`)
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
        $db = $this->getDefaultAdapter();
            
        try {
            $db->query("
                INSERT INTO `page_meta` (`page_meta_id`, `page_id`, `page_title`, `meta_title`, `meta_description`, `meta_keyword`, `language`, `modified`) VALUES
                (1, 7, 'Pages', 'Pages', 'All Pages', 'pages', 'en_Us', '2013-12-12 23:48:04'),
                (2, 9, 'Create New Page', 'Create New Page', 'Create New Page', 'Create New Page', 'en_Us', '2013-12-13 00:26:00'),
                (3, 10, 'View Page', 'View Page', 'View Page', 'View Page', 'en_Us', '2013-12-13 00:29:07'),
                (4, 11, 'Create New Module', 'Create New Module', 'Create New Module', 'Create New Module', 'en_Us', '2013-12-13 00:30:10'),
                (5, 1, 'Admin Home', 'Admin Home', 'Admin Home', 'Admin Home', 'en_Us', '2013-12-13 00:31:41'),
                (6, 12, 'Admin Accounts', 'Admin Accounts', 'Admin Accounts', 'Admin Accounts', 'en_Us', '2013-12-13 00:32:58'),
                (7, 13, 'View Configuration', 'View Configuration', 'View Configuration', 'View Configuration', 'en_Us', '2013-12-13 00:33:52'),
                (8, 4, 'Update Configuration', 'Update Configuration', 'Update Configuration', 'Update Configuration', 'en_Us', '2013-12-13 00:35:22'),
                (9, 14, 'View Account', 'View Account', 'View Account', 'View Account', 'en_Us', '2013-12-13 00:36:47'),
                (10, 15, 'Update Account', 'Update Account', 'Update Account', 'Update Account', 'en_Us', '2013-12-13 00:37:45'),
                (11, 16, 'Delete Account', 'Delete Account', 'Delete Account', 'Delete Account', 'en_Us', '2013-12-13 00:39:08'),
                (12, 17, 'Create Account', 'Create Account', 'Create Account', 'Create Account', 'en_Us', '2013-12-13 00:40:03'),
                (13, 8, 'Search Results', 'Search Results', 'Search Results', 'Search Results', 'en_Us', '2013-12-13 00:41:46'),
                (14, 2, 'Access Controls', 'Access Controls', 'Access Controls', 'Access Controls', 'en_Us', '2013-12-13 00:43:17'),
                (15, 5, 'Languages', 'Languages', 'Languages', 'Languages', 'en_Us', '2013-12-13 00:43:40'),
                (16, 6, 'Navigation', 'Navigation', 'Navigation', 'Navigation', 'en_Us', '2013-12-13 00:44:01'),
                (17, 18, 'Update Page', 'Update Page', 'Update Page', 'Update Page', 'en_Us', '2013-12-13 11:20:22'),
                (18, 19, 'Delete Page', 'Delete Page', 'Delete Page', 'Delete Page', 'en_Us', '2013-12-13 11:26:13'),
                (19, 20, 'View Translation', 'View Translation', 'View Translation', 'View Translation', 'en_Us', '2013-12-13 23:19:25'),
                (20, 21, 'Update Translation', 'Update Translation', 'Update Translation', 'Update Translation', 'en_Us', '2013-12-14 00:10:37'),
                (21, 22, 'Cache', 'Cache', 'Cache', 'Cache', 'en_Us', '2013-12-16 17:54:48'),
                (22, 23, 'Clean All Caches', 'Clean All Caches', 'Clean All Caches', 'Clean All Caches', 'en_Us', '2013-12-16 17:55:26'),
                (23, 24, 'Rebuild Caches', 'Rebuild Caches', 'Rebuild Caches', 'Rebuild Caches', 'en_Us', '2013-12-16 17:56:09'),
                (24, 25, 'Search Admin', 'Search Admin', 'Search Admin', 'Search Admin', 'en_Us', '2013-12-16 17:57:12'),
                (25, 26, 'Re-Index Search', 'Re-Index Search', 'Re-Index Search', 'Re-Index Search', 'en_Us', '2013-12-16 17:57:54'),
                (26, 27, 'Logs', 'Logs', 'Logs', 'Logs', 'en_Us', '2013-12-16 17:58:40'),
                (27, 28, 'Clear Log', 'Clear Log', 'Clear Log', 'Clear Log', 'en_Us', '2013-12-16 17:59:34'),
                (28, 29, 'Import Navigation', 'Import Navigation', 'Import Navigation', 'Import Navigation', 'en_Us', '2013-12-16 18:02:12'),
                (29, 30, 'Development', 'Development', 'Development', 'Development', 'en_Us', '2013-12-16 18:03:40'),
                (30, 31, 'Update Role', 'Update Role', 'Update Role', 'Update Role', 'en_Us', '2013-12-16 18:54:46'),
                (31, 32, 'Delete Role', 'Delete Role', 'Delete Role', 'Delete Role', 'en_Us', '2013-12-16 18:55:19'),
                (32, 33, 'Update Resource', 'Update Resource', 'Update Resource', 'Update Resource', 'en_Us', '2013-12-16 19:50:38'),
                (33, 34, 'Delete Resource', 'Delete Resource', 'Delete Resource', 'Delete Resource', 'en_Us', '2013-12-16 19:51:27'),
                (34, 35, 'Update Rule', 'Update Rule', 'Update Rule', 'Update Rule', 'en_Us', '2013-12-16 19:56:51'),
                (35, 36, 'Delete Rule', 'Delete Rule', 'Delete Rule', 'Delete Rule', 'en_Us', '2013-12-16 19:58:35');
                    ");
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
}