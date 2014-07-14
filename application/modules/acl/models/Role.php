<?php
class Acl_Model_Role
{
    protected $_table;

    protected $_cache;
    
    public function findAll()
    {
        $cacheId = md5('Application_Model_Acl_Role::findAll');
         
        if($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
        
            try {
                $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
                
                $select->joinLeft('acl_role', 'acl_role_2.acl_role_id = acl_role.acl_role_child', 
                        array('acl_role_name as acl_role_child_name'));
                $rowSet = $this->getTable()->fetchAll($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
        }
    }


    public function findById($aclRoleId)
    {
        $cacheId = md5('Application_Model_Acl_Role::findById_' . $aclRoleId);
         
        if($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
            try { 
                $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
                
                $select->where('acl_role_id = ?', $aclRoleId);
                
                $rowSet = $this->getTable()->fetchRow($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
                
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
            
        }
    }


    public function save($aclRoleName, $aclRoleDisplay, $aclRoleChild, $aclRoleId = null)
    {
        $data = array(
        	'acl_role_name' => $aclRoleName,
                'acl_role_display' => $aclRoleDisplay,
                'acl_role_child' => $aclRoleChild
        );
        
        if($aclRoleId == null) {
            $aclRoleId = $this->create($data);
        } else {
            $this->update($aclRoleId, $data);
        }
        
        return $aclRoleId;
    }


    public function create($data)
    {
        try {
            $this->getTable()->insert($data);
        
            $this->getCache()->clean();
        
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    public function update($aclRoleId, $data)
    {
        try {
            $where = $this->getTable()->getDefaultAdapter()
            ->quoteInto('acl_role_id = ?', $aclRoleId);
            $this->getTable()->update($data, $where);
        
            $this->getCache()->clean();
        
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    function delete($aclRoleId)
    {
        try {
             
            $where = $this->getTable()->getDefaultAdapter()->quoteInto('acl_role_id = ?', $aclRoleId);
             
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

    public function getTable()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Acl_Model_DbTable_Role();
            return $this->_table;
        }
    }
}