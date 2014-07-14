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
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Page.php 1.0  Jaimie Garner $
 */
class Page_Model_Page extends Application_Model_Model {

  /**
   * 
   * @var unknown
   */
  private $_table = null;

  /**
   * Finds all pages
   *
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function findAll() {
    $cacheId = md5('Page_Model_Page::findAll');

    $select = $this->getSelect()
        ->joinLeft('acl_resource', 'page.acl_resource_id = acl_resource.acl_resource_id')
        ->order('module');

    return $this->getRowSet($select, $cacheId, $this->getTable());
  }

  /**
   * Finds page by pageId
   *
   * @param int $pageId            
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function findById($pageId) {
    $cacheId = md5('Page_Model_Page::findById_' . $pageId);

    $select = $this->getSelect()
        ->where('page_id = ?', $pageId)
        ->joinLeft('acl_resource', 'page.acl_resource_id = acl_resource.acl_resource_id');

    return $this->getRow($select, $cacheId, $this->getTable());
  }

  /**
   * 
   * @param unknown $route
   * @param unknown $module
   * @param unknown $controller
   * @param unknown $action
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function findByRequest($route, $module, $controller, $action) {
    $cacheId = md5('Page_Model_Page::findByRequest_' . $route . '_' . $module . '_' . $controller . '_' . $action);

    $select = $this->getSelect()
        ->where('route = ?', $route)
        ->where('module = ?', $module)
        ->where('controller = ?', $controller)
        ->where('action = ?', $action);

    return $this->getRow($select, $cacheId, $this->getTable());
  }

  /**
   * 
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function findAllModules() {
    $cacheId = md5('Page_Model_Page::findAllModules');

    $select = $this->getSelect()->group('module');

    return $this->getRowSet($select, $cacheId, $this->getTable());
  }

  /**
   * Saves a page row
   *
   * @param string $route            
   * @param string $module            
   * @param string $controller            
   * @param string $action            
   * @param int $aclResourceId            
   * @param string $pageId            
   * @return Ambigous <string, mixed, multitype:>
   */
  public function save($route, $module, $controller, $action, $aclResourceId, $breadcrumb, $cache, $pageId = null) {
    $data = array(
      'route' => $route,
      'module' => $module,
      'controller' => $controller,
      'action' => $action,
      'acl_resource_id' => $aclResourceId,
      'breadcrumb' => $breadcrumb,
      'cache' => $cache
    );

    if ($pageId == null) {
      $pageId = $this->create($data);
    }
    else {
      $this->update($pageId, $data);
    }

    return $pageId;
  }

  /**
   * Saves row to database
   *
   * @param array $data            
   * @throws Zend_Exception
   * @return int <mixed, multitype:>
   */
  private function create($data) {
    try {

      $pageId = $this->getTable()->insert($data);

      $this->getCache()->clean();

      return $pageId;
    }
    catch (Exception $e) {
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
  private function update($pageId, $data) {
    try {

      $where = $this->getTable()
          ->getDefaultAdapter()
          ->quoteInto('page_id = ?', $pageId);

      $this->getTable()->update($data, $where);

      $this->getCache()->clean();
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }

  /**
   * Deletes a database row
   *
   * @param int $pageId            
   * @throws Zend_Exception
   */
  public function delete($pageId) {
    try {

      $where = $this->getTable()
          ->getDefaultAdapter()
          ->quoteInto('page_id', $pageId);

      $this->getTable()->delete($where);

      $this->getCache()->clean();
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }

  /**
   * Returns the database table object
   *
   * @return Page_Model_DbTable_Page
   */
  protected function getTable() {
    if (null !== $this->_table) {
      return $this->_table;
    }
    else {
      $this->_table = new Page_Model_DbTable_Page();
      return $this->_table;
    }
  }

}
