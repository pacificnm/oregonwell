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
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Resource.php 1.0  Jaimie Garner $
 */
class Acl_Model_Resource
{

    /**
     *
     * @var object Acl_Model_DbTable_Resource
     */
    protected $_table;

    /**
     *
     * @var object Zend_Cache
     */
    protected $_cache;

    /**
     *
     * @var object Zend_Db_Select
     */
    private $_select = null;

    /**
     *
     * @throws Zend_Exception
     * @return unknown
     */
    public function findAll ()
    {
        $cacheId = md5('findAll');
        
        $select = $this->getSelect();
        
        return $this->getRowSet($select, $cacheId);
    }

    /**
     * Gets a table row by acl_resource_id
     *
     * @param unknown $aclResourceId            
     * @return Zend_Db_Table_Row_Abstract
     */
    public function findById ($aclResourceId)
    {
        $cacheId = md5('findById_' . $aclResourceId);
        
        $select = $this->getSelect()->where('acl_resource_id = ?', 
                $aclResourceId);
        
        return $this->getRow($select, $cacheId);
    }

    /**
     * Saves a table row
     *
     * @param string $aclResourceName            
     * @param string $aclResourceDisplay            
     * @param int $aclResourceId            
     * @return int
     */
    public function save ($aclResourceName, $aclResourceDisplay, 
            $aclResourceId = null)
    {
        $data = array(
                'acl_resource_name' => $aclResourceName,
                'acl_resource_display' => $aclResourceDisplay
        );
        
        if ($aclResourceId == null) {
            $aclResourceId = $this->create($data);
        } else {
            $this->update($aclResourceId, $data);
        }
        
        return $aclResourceId;
    }

    /**
     * Creates a table row
     *
     * @param unknown $data            
     * @throws Zend_Exception
     * @return int
     */
    private function create ($data)
    {
        try {
            $aclResourceId = $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
            return $aclResourceId;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Updates a table row
     *
     * @param int $aclResourceId            
     * @param aray $data            
     * @throws Zend_Exception
     */
    private function update ($aclResourceId, $data)
    {
        try {
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('acl_resource_id = ?', $aclResourceId);
            $this->getTable()->update($data, $where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Deletes a table row by acl_resource_id
     *
     * @param int $aclResourceId            
     * @throws Zend_Exception
     */
    public function delete ($aclResourceId)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('acl_resource_id = ?', $aclResourceId);
            
            $this->getTable()->delete($where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Returns the Select Object
     *
     * @return Zend_Db_Select
     */
    private function getSelect ()
    {
        if (null !== $this->_select) {
            return $this->_select;
        } else {
            $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
            
            $this->_select = $select;
            
            return $this->_select;
        }
    }

    /**
     * Returns a set of database rows
     *
     * @param object $select            
     * @param string $cacheId            
     * @throws Zend_Exception
     * @return Zend_Db_Table_Rowset_Abstract
     */
    private function getRowSet ($select, $cacheId)
    {
        if ($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
            
            try {
                $rowSet = $this->getTable()->fetchAll($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
        }
    }

    /**
     * Returns a single database row
     *
     * @param object $select            
     * @param string $cacheId            
     * @throws Zend_Exception
     * @return Zend_Db_Table_Row_Abstract
     */
    private function getRow ($select, $cacheId)
    {
        if ($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
            try {
                $rowSet = $this->getTable()->fetchRow($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
        }
    }

    /**
     * Loads the table cache
     * 
     * @return object Zend_Cache
     */
    private function getCache ()
    {
        if (null !== $this->_cache) {
            return $this->_cache;
        } else {
            $this->_cache = Zend_Registry::get('Zend_Cache');
            return $this->_cache;
        }
    }

     /**
     * Returns the database table object
     *
     * @return object Acl_Model_DbTable_Resource
     */
    private function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Acl_Model_DbTable_Resource();
            return $this->_table;
        }
    }
}