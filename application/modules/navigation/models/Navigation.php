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
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Page.php 1.0  Jaimie Garner $
 */
class Navigation_Model_Navigation extends Application_Model_Model
{

    /**
     *
     * @var unknown
     */
    private $_table = null;

    public function findAll()
    {
        $cacheId = md5('Navigation_Model_Navigation::findAll');
        
        $select = $this->getSelect();
        
        $rowSet = $this->getRowSet($select, $cacheId, $this->getTable());
        
        return $rowSet;
    }
    
    public function findByParent($parentId)
    {
        $cacheId = md5('Navigation_Model_Navigation::findByParent_' . $parentId);
        
        $select = $this->getSelect()->where('parent_id = ?', $parentId)
            ->joinLeft('acl_resource', 'navigation.acl_resource_id = acl_resource.acl_resource_id');
        
        $rowSet = $this->getRowSet($select, $cacheId, $this->getTable());
        
        return $rowSet;
    }
    
    public function findByKey ($key)
    {
        $cacheId = md5('Navigation_Model_Navigation::findByKey_' . $key);
        
        $select = $this->getSelect()->where('navigation_key = ?', $key);
        
        $rowSet = $this->getRow($select, $cacheId, $this->getTable());
        
        return $rowSet;
    }

    public function save ($parentId, $key, $label, $module, $controller, $action, 
            $aclResourceId, $visible, $resetParams, $navigationId = null)
    {
        $data = array(
                'parent_id' => $parentId,
                'navigation_key' => $key,
                'label' => $label,
                'module' => $module,
                'controller' => $controller,
                'action' => $action,
                'acl_resource_id' => $aclResourceId,
                'visible' => $visible,
                'reset_params' => $resetParams
        );
        
        if ($navigationId == null) {
            $navigationId = $this->create($data);
        } else {
            $this->update($navigationId, $data);
        }
        
        return $navigationId;
    }

    /**
     * Saves row to database
     *
     * @param array $data            
     * @throws Zend_Exception
     * @return int <mixed, multitype:>
     */
    private function create ($data)
    {
        try {
            
            $navigationId = $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
            return $navigationId;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Updates a database row
     *
     * @param int $pageId            
     * @param array $data            
     * @throws Zend_Exception
     */
    private function update ($navigationId, $data)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('navigation_id = ?', $navigationId);
            
            $this->getTable()->update($data, $where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Deletes a database row
     *
     * @param int $pageId            
     * @throws Zend_Exception
     */
    public function delete ($navigationId)
    {
        try {
            
            $where = $this->getTable($navigationId)
                ->getDefaultAdapter()
                ->quoteInto('navigation_id', $navigationId);
            
            $this->getTable()->delete($where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    public function truncate()
    {
        $db = $this->getTable()->getDefaultAdapter();
        
        $db->query('TRUNCATE navigation');
        
    }
    
    /**
     * Returns the database table object
     *
     * @return Page_Model_DbTable_Page
     */
    public function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Navigation_Model_DbTable_Navigation();
            return $this->_table;
        }
    }
}