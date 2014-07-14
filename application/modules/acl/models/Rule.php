<?php
class Acl_Model_Rule
{
    /**
     * 
     * @var Application_Model_DbTable_ACL_Rule
     */
    protected $_table;

   
    protected $_cache;

    
    /**
     * Finds all ACL Rules
     * 
     * @throws Zend_Exception
     * @return  <mixed, false, boolean, string>|Zend_Db_Table_Rowset_Abstract
     */
    public function findAll()
    {
        $cacheId = md5('Application_Model_Acl_Rule::findAll');
         
        if($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
            try {
                $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
                
                $select->joinLeft('acl_resource', 'acl_resource.acl_resource_id = acl_rule.acl_resource_id')
                    ->joinLeft('acl_role', 'acl_role.acl_role_id = acl_rule.acl_role_id');
                
                $rowSet = $this->getTable()->fetchAll($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
                
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }

        }
    }


    /**
     * Finds ACL Rule by id
     * @param int $aclRuleId
     * @return Ambigous <mixed, false, boolean, string>
     */
    public function findById($aclRuleId)
    {
         $cacheId = md5('Application_Model_Acl_Rule::findById_' . $aclRuleId);
         
         if($rowSet = $this->getCache()->load($cacheId)) {
             return $rowSet;
         } else {
            try {
                $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
                
                $select->where('acl_rule_id = ?', $aclRuleId);
                
                $rowSet = $this->getTable()->fetchRow($select);
                
                 $this->getCache()->save($rowSet, $cacheId);
                
                 return $rowSet;
                 
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
         }
    }


    /**
     * Saves an ACL Rule
     * 
     * @param int $aclResourceId
     * @param int $aclRoleId
     * @param string $aclType
     * @param int $aclRuleId
     * @return int
     */
    public function save($aclResourceId, $aclRoleId, $aclType, $aclRuleId = null)
    {
        $data = array(
	       'acl_resource_id' => $aclResourceId,
                'acl_role_id' => $aclRoleId,
                'acl_type' => $aclType
        );
        
        if($aclRuleId == null) {
           $aclRuleId = $this->create($data);
        } else {
            $this->update($aclRuleId, $data);
        }
        
        return $aclRuleId;
    }


    /**
     * Creates new ACL Rule
     * 
     * @param array $data
     * @throws Zend_Exception
     */
    public function create($data)
    {
        try {
            $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    
    /**
     * Updates an ACL Rule
     * 
     * @param int $aclRuleId
     * @param array $data
     * @throws Zend_Exception
     */
    public function update($aclRuleId, $data)
    {
        try {
            $where = $this->getTable()->getDefaultAdapter()
                ->quoteInto('acl_rule_id = ?', $aclRuleId);
            $this->getTable()->update($data, $where);
            
            $this->getCache()->clean();
            
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    
    /**
     * Deletes an ACL Rule
     * 
     * @param int $aclRuleId
     * @throws Zend_Exception
     */
    function delete($aclRuleId)
    {
         try {
             
             $where = $this->getTable()->getDefaultAdapter()->quoteInto('acl_rule_id = ?', $aclRuleId);
             
             $this->getTable()->delete($where);
             
             $this->getCache()->clean();
             
         } catch (Exception $e) {
             throw new Zend_Exception($e->getMessage());
         }
    }


    /**
     * gets the Cache
     * @return  <Zend_Cache_Core, Zend_Cache_Frontend, mixed>
     */
    public function getCache()
    {
        if (null !== $this->_cache) {
            return $this->_cache;
        } else {
            $this->_cache = Zend_Registry::get('Zend_Cache');
            
            
            
            return $this->_cache;
        }
    }
    
    /**
     * Gets the DBTable Adapter
     * 
     * @return Application_Model_DbTable_ACL_Rule
     */
    public function getTable()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Acl_Model_DbTable_Rule();
            return $this->_table;
        }
    }
}