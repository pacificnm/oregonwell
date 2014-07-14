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
 * @category   Application
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Model.php 1.0  Jaimie Garner $
 */
class Application_Model_Model
{

    /**
     *
     * @var Zend_Cache
     */
    private $_cache = null;

    /**
     *
     * @var object Application_Model_Crypt
     */
    private $_cryptModel = null;
    
    /**
     * Gets the Crypt Model object
     *
     * @return object Application_Model_Crypt
     */
    protected function getCryptModel ()
    {
        if (null !== $this->_cryptModel) {
            return $this->_cryptModel;
        } else {
            $this->_cryptModel = new Application_Model_Crypt();
            return $this->_cryptModel;
        }
    }
    
    /**
     * Returns the cache object
     *
     * @return Zend_Cache
     */
    public function getCache ()
    {
        if (null !== $this->_cache) {
            return $this->_cache;
        } else {
          
            $this->_cache = Zend_Registry::get('Zend_Cache');
            
            Zend_Db_Table_Abstract::setDefaultMetadataCache(
                    Zend_Registry::get('Zend_Cache'));
            
            return $this->_cache;
        }
    }

    /**
     * Returns the Select Object
     *
     * @return Ambigous <Zend_Db_Select, Zend_Db_Table_Select>
     */
    public function getSelect ()
    {
        $select = $this->getTable()
            ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false);
        
        return $select;
    }

    
    /**
     * Returns a set of database rows
     *
     * @param object $select
     *            Zend_Db_Select
     * @param string $cacheId
     *            * @param object $table
     *            Zend_Db_Table_Abstract
     * @throws Zend_Exception
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getRowSet ($select, $cacheId, $table)
    {
    	
    	if($cacheId != null) {
    	
	        if ($rowSet = $this->getCache()->load($cacheId)) {
	            return $rowSet;
	        } else {
	            
	            try {
	                $rowSet = $table->fetchAll($select);
	                
	                // $this->getCache()->save($rowSet, $cacheId);
	                
	                return $rowSet;
	            } catch (Exception $e) {
	                throw new Zend_Exception($e->getMessage());
	            }
	        }
    	} else {
    		try {
    			$rowSet = $table->fetchAll($select);
       			 
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
     *            Zend_Db_Select
     * @param string $cacheId            
     * @param object $table
     *            Zend_Db_Table_Abstract
     * @throws Zend_Exception
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getRow ($select, $cacheId, $table)
    {
    	if($cacheId != null) {
    	
	        if ($rowSet = $this->getCache()->load($cacheId)) {
	            return $rowSet;
	        } else {
	            try {
	                $rowSet = $table->fetchRow($select);
	                
	                $this->getCache()->save($rowSet, $cacheId);
	                
	                return $rowSet;
	            } catch (Exception $e) {
	                throw new Zend_Exception($e->getMessage());
	            }
	        }
    	} else {
    		try {
    			$rowSet = $table->fetchRow($select);
    			 
    			return $rowSet;
    		} catch (Exception $e) {
    			throw new Zend_Exception($e->getMessage());
    		}
    	}
    }

    /**
     * Get Paginated Table Rows
     *
     * @param int $page            
     * @param Object $select
     *            Zend_Db_Select
     * @param string $cacheId            
     * @throws Zend_Exception
     * @return Zend_Paginator
     */
    public function getPaginator ($page, $select, $cacheId)
    {
        $config = Zend_Registry::get('Application_Config');
        
        
        if($cacheId != null ) {
        
	        if ($paginator = $this->getCache()->load($cacheId)) {
	            return $paginator;
	        } else {
	            try {
	                $paginator = Zend_Paginator::factory($select);
	                
	                $paginator->setItemCountPerPage(10)
	                    ->setPageRange(10)
	                    ->setCurrentPageNumber($page);
	                
	                // $this->getCache()->save($paginator, $cacheId);
	                
	                return $paginator;
	            } catch (Exception $e) {
	                throw new Zend_Exception($e->getMessage());
	            }
	        }
        } else {
        	try {
        		$paginator = Zend_Paginator::factory($select);
        		 
        		$paginator->setItemCountPerPage(25)
        		->setPageRange(10)
        		->setCurrentPageNumber($page);
        		
        		return $paginator;
        	} catch (Exception $e) {
        		throw new Zend_Exception($e->getMessage());
        	}
        }
    }
}