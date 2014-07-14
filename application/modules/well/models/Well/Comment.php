<?php
class Well_Model_Well_Comment extends Application_Model_Model
{

    /**
     *
     * @var unknown
     */
    private $_table = null;

    public function findByWell($wellId, $private, $deleted)
    {
        $select = $this->getSelect()->where('well_id = ?', $wellId)
            ->join('auth', 'well_comment.user_id = auth.auth_id')
            ->join('acl_role', 'auth.acl_role_id = acl_role.acl_role_id');
        
        if($private == true) {
            $select->where('well_comment_private = ?', 1);
        } else {
            $select->where('well_comment_private = ?', 0);
        }
        
        if($deleted == true) {
            $select->where('well_comment_deleted = ?', 1);
        } else {
            $select->where('well_comment_deleted = ?', 0);
        }
        
        $rowSet = $this->getRowSet($select, null, $this->getTable());
        
        return $rowSet;
    }
    
    public function findById($id)
    {
        $select = $this->getSelect()->where('id = ?', $id);
        
        return $this->getRow($select, null, $this->getTable());
    }
    
    public function save($userId, $wellId, $wellCommentTxt, 
            $wellCommentPrivate, $wellCommentCreated, $wellCommentDeleted, $id = null)
    {
        
    }
    
    public function create($data)
    {
        try {
        
            $id = $this->getTable()->insert($data);
        
            $this->getCache()->clean();
        
            return $id;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
    
    public function update($id, $data)
    {
        $where = $this->getTable()->getDefaultAdapter()->quoteInto("id = ?", $id);
        
         $this->getTable()->update($data, $where);
    }
    
    public function delete($id) {
        $where = $this->getTable()->getDefaultAdapter()->quoteInto("id = ?", $id);
        
        $this->getTable()->delete($where);
    }  
    
    /**
     * @returns Well_Model_DbTable_Well_Comment
     * 
     */ function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Well_Model_DbTable_Well_Comment();
            return $this->_table;
        }
    }
}