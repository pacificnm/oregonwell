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
 * @category   Navigation
 * @package    Model
 * @subpackage DbTable
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Navigation.php 1.0  Jaimie Garner $
 */
class Navigation_Model_DbTable_Navigation extends Zend_Db_Table_Abstract
{
    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'navigation';

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
            $db->query('CREATE TABLE IF NOT EXISTS `navigation` (
              `navigation_id` int(11) NOT NULL AUTO_INCREMENT,
              `parent_id` int(11) NOT NULL,
              `navigation_key` varchar(100) NOT NULL,
              `label` varchar(100) NOT NULL,
              `module` varchar(100) NOT NULL,
              `controller` varchar(100) NOT NULL,
              `action` varchar(100) NOT NULL,
              `acl_resource_id` int(11) NOT NULL,
              `visible` int(3) NOT NULL,
              `reset_params` int(3) NOT NULL,
              PRIMARY KEY (`navigation_id`)
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
        $db = $this->getDefaultAdapter();
            $db->query("
            INSERT INTO `navigation` (`navigation_id`, `parent_id`, `navigation_key`, `label`, `module`, `controller`, `action`, `acl_resource_id`, `visible`, `reset_params`) VALUES
            (1, 0, 'default_default_index_index', 'Home', 'default', 'index', 'index', 2, 0, 0),
            (2, 0, 'default_music_album_index', 'Albums', 'music', 'album', 'index', 2, 0, 0),
            (3, 0, 'default_music_artist_index', 'Artists', 'music', 'artist', 'index', 2, 0, 0),
            (4, 0, 'default_music_track_index', 'Tracks', 'music', 'track', 'index', 2, 0, 0),
            (5, 0, 'default_music_genre_index', 'Genre', 'music', 'genre', 'index', 2, 0, 0),
            (6, 0, 'default_auth_view_index', 'My Account', 'auth', 'view', 'index', 5, 0, 0),
            (7, 6, 'default_auth_update_index', 'Update My Account', 'auth', 'update', 'index', 5, 0, 0),
            (8, 6, 'default_auth_update_password', 'Change Password', 'auth', 'update', 'password', 5, 0, 0),
            (9, 0, 'default_admin_index', 'Admin', 'default', 'admin', 'index', 7, 0, 0),
            (10, 9, 'default_auth_index', 'Accounts', 'auth', 'admin', 'index', 7, 0, 0),
            (11, 10, 'default_auth_create', 'Create Account', 'default', 'auth', 'create', 7, 0, 0),
            (12, 9, 'default_acl_index', 'ACL', 'acl', 'index', 'index', 7, 0, 0),
            (13, 12, 'default_acl_update_role', 'Update Role', 'acl', 'update', 'role', 7, 0, 0),
            (14, 12, 'default_acl_delete_role', 'Delete Role', 'acl', 'delete', 'role', 7, 0, 0),
            (15, 12, 'default_acl_update_resource', 'Update Resource', 'acl', 'update', 'resource', 7, 0, 0),
            (16, 12, 'default_acl_delete_resource', 'Delete Resource', 'acl', 'delete', 'resource', 7, 0, 0),
            (17, 12, 'default_acl_create_role', 'Create Role', 'acl', 'create', 'role', 7, 0, 0),
            (18, 12, 'default_acl_create_resource', 'Create Resource', 'acl', 'create', 'resource', 7, 0, 0),
            (19, 12, 'default_acl_create_rule', 'Create Rule', 'acl', 'create', 'rule', 7, 0, 0),
            (20, 12, 'defualt_acl_update_rule', 'Update Rule', 'acl', 'update', 'rule', 7, 0, 0),
            (21, 12, 'default_acl_delete_rule', 'Delete Rule', 'acl', 'delete', 'rule', 7, 0, 0),
            (22, 9, 'default_development_index_index', 'Development', 'development', 'index', 'index', 7, 0, 0),
            (23, 22, 'default_development_index_style', 'Style Guide', 'development', 'index', 'style', 7, 0, 0),
            (24, 22, 'default_development_index_components', 'Components', 'development', 'index', 'component', 7, 0, 0),
            (25, 22, 'default_development_index_javascript', 'Javascript', 'development', 'index', 'javascript', 7, 0, 0),
            (26, 22, 'default_development_index_class', 'Classes', 'development', 'index', 'class', 7, 0, 0),
            (27, 9, 'default_page_index', 'Pages', 'page', 'index', 'index', 7, 0, 0),
            (28, 27, 'default_page_create_module', 'Create Module', 'page', 'create', 'module', 7, 0, 0),
            (29, 27, 'default_page_create_page', 'Create Page', 'page', 'create', 'page', 7, 0, 0),
            (30, 27, 'default_page_view_page', 'View Page', 'page', 'view', 'index', 7, 0, 0),
            (31, 27, 'default_page_create_meta', 'Create Translation', 'page', 'create', 'meta', 7, 0, 0),
            (32, 27, 'defult_page_update_page', 'Update Page', 'page', 'update', 'page', 7, 0, 0);
                    ");
        try {
            
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
    
}