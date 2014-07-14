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
 * @subpackage Page
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Meta.php 1.0  Jaimie Garner $
 */
class Page_Model_Page_Meta extends Application_Model_Model
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    private $_table = null;

    /**
     *
     * @var Zend_Db_Select_Abstract
     */
    private $_select = null;

    /**
     *
     * @var Zend_Cache
     */
    private $_cache = null;

    /**
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findAll ()
    {
        $cacheId = md5('findAll');
        
        $select = $this->getSelect();
        
        return $this->getRowSet($select, $cacheId, $this->getTable());
    }

    /**
     *
     * @param unknown $pageId            
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findAllByPage ($pageId)
    {
        $cacheId = md5('findAllByPage_' . $pageId);
        
        $select = $this->getSelect()->where('page_id = ?', $pageId);
        
        return $this->getRowSet($select, $cacheId, $this->getTable());
    }

    /**
     * Gets Meta information by page_id and language
     *
     * @param int $pageId            
     * @param string $language            
     * @return Ambigous <Ambigous, Zend_Db_Table_Row_Abstract, NULL, unknown>
     */
    public function findByPageLanguage ($pageId, $language)
    {
        $cacheId = md5('findByPageLanguage');
        
        $select = $this->getSelect()
            ->where('page_id = ?', $pageId)
            ->where('language = ?', $language);
        
        return $this->getRow($select, $cacheId, $this->getTable());
    }

    /**
     *
     * @param unknown $pageMetaId            
     * @return Ambigous <Zend_Db_Table_Row_Abstract, NULL, unknown>
     */
    public function findById ($pageMetaId)
    {
        $cacheId = md5('findById_' . $pageMetaId);
        
        $select = $this->getSelect()->where('page_meta_id = ?', $pageMetaId);
        
        return $this->getRow($select, $cacheId, $this->getTable());
    }

    /**
     *
     * @param unknown $pageId            
     * @param unknown $pageTitle            
     * @param unknown $metaTitle            
     * @param unknown $metaDescription            
     * @param unknown $metaKeyword            
     * @param unknown $language            
     * @param string $pageMetaId            
     * @return Ambigous <string, mixed, multitype:>
     */
    public function save ($pageId, $pageTitle, $metaTitle, $metaDescription, 
            $metaKeyword, $language, $pageMetaId = null)
    {
        $data = array(
                'page_id' => $pageId,
                'page_title' => $pageTitle,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'meta_keyword' => $metaKeyword,
                'language' => $language
        );
        
        if ($pageMetaId == null) {
            $pageMetaId = $this->create($data);
        } else {
            $this->update($pageMetaId, $data);
        }
        
        return $pageMetaId;
    }

    /**
     *
     * @param unknown $data            
     * @throws Zend_Exception
     * @return Ambigous <mixed, multitype:>
     */
    private function create ($data)
    {
        try {
            
            $pageId = $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
            return $pageId;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     *
     * @param unknown $pageMetaId            
     * @param unknown $data            
     * @throws Zend_Exception
     */
    private function update ($pageMetaId, $data)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('page_meta_id = ?', $pageMetaId);
            
            $this->getTable()->update($data, $where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     *
     * @param unknown $pageMetaId            
     * @throws Zend_Exception
     */
    public function delete ($pageMetaId)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('page_metat_id', $pageMetaId);
            
            $this->getTable()->delete($where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

   
    /**
     * Returns the database table object
     *
     * @return Page_Model_DbTable_Page
     */
    protected function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Page_Model_DbTable_Page_Meta();
            return $this->_table;
        }
    }
}
