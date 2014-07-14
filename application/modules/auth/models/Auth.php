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
 * @category   Auth
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Auth.php 1.0  Jaimie Garner $
 */
class Auth_Model_Auth extends Application_Model_Model
{

    /**
     * 
     * @var Auth_Model_DbTable_Auth
     */
    protected $_table;

    /**
     * 
     * @var Zend_Cache
     */
    protected $_cache;
    
    

    /**
     * 
     * @throws Zend_Exception
     * @return unknown|Zend_Db_Table_Rowset_Abstract
     */
    public function findAll ()
    {
        $cacheId = md5('Auth_Model_Auth::findAll');
        
        if ($rowSet = $this->getCache()->load($cacheId)) {
            return $rowSet;
        } else {
            
            try {
                
                $select = $this->getTable()
                    ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                    ->setIntegrityCheck(false);
                
                $select->joinLeft('acl_role', 
                        'auth.acl_role_id = acl_role.acl_role_id');
                
                $rowSet = $this->getTable()->fetchAll($select);
                
                $this->getCache()->save($rowSet, $cacheId);
                
                return $rowSet;
            } catch (Exception $e) {
                throw new Zend_Exception($e->getMessage());
            }
        }
    }

    /**
     * 
     * @param int $authId
     * @throws Zend_Exception
     * @return Ambigous <Zend_Db_Table_Row_Abstract, NULL, unknown>
     */
    public function findById ($authId)
    {
        try {
            
            $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
            
            $select->where('auth_id = ?', $authId)
                ->join('acl_role', 'auth.acl_role_id = acl_role.acl_role_id');
            
            $rowSet = $this->getTable()->fetchRow($select);
                
            return $rowSet;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    
    /**
     * 
     * @param string $username
     * @throws Zend_Exception
     * @return Ambigous <Zend_Db_Table_Row_Abstract, NULL, unknown>
     */
    public function findByUsername ($username)
    {
        try {
            
            $select = $this->getTable()
                ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
            
            $select->where('username = ?', $username);
            
            $rowSet = $this->getTable()->fetchRow($select);
            
            return $rowSet;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    
    /**
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $name
     * @param int $aclRoleId
     * @param int $authId
     * @return Ambigous <string, mixed, multitype:>
     */
    public function save ($username, $email, $password, $name, $authType, $aclRoleId, $userId, $employeeId,
            $authId = null)
    {
        $data = array(
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'name' => $name,
        		     'auth_type' => $authType,
                'acl_role_id' => $aclRoleId,
                'user_id' => $userId,
                'employee_id' => $employeeId
        );
        
        if ($authId == null) {
            $authId = $this->create($data);
        } else {
            $this->update($authId, $data);
        }
        
        return $authId;
    }

    
    /**
     * 
     * @param array $data
     * @throws Zend_Exception
     * @return Ambigous <mixed, multitype:>
     */
    private function create ($data)
    {
        try {
            
            $authId = $this->getTable()->insert($data);
            
            $this->getCache()->clean();
            
            return $authId;
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * 
     * @param int $authId
     * @param array $data
     * @throws Zend_Exception
     */
    private function update ($authId, $data)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('auth_id = ?', $authId);
            
            $this->getTable()->update($data, $where);
            
            $this->getCache()->clean();
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    
    /**
     * 
     * @param int $authId
     * @throws Zend_Exception
     */
    public function delete ($authId)
    {
        try {
            
            $where = $this->getTable()
                ->getDefaultAdapter()
                ->quoteInto('auth_id', $authId);
            
            $this->getTable()->delete($where);
            
            $this->getCache()->clean();
            
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * 
     * @param array $values
     * @return boolean
     */
    public function process ($values)
    {
        
        $adapter = $this->_getAuthAdapter();
        
        $adapter->setIdentity($values['username']);
        
        $adapter->setCredential($this->getCryptModel()->decrypt($values['password']));
        
        $auth = Zend_Auth::getInstance();
       
        
        $result = $auth->authenticate($adapter);
      
        
        if ($result->isValid()) {
            $authUser = $this->findByUsername($values['username']);
            
            $auth->getStorage()->write($authUser);
            
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return Zend_Auth_Adapter_DbTable
     */
    protected function _getAuthAdapter ()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('auth')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password');
        
        return $authAdapter;
    }

    
    /**
     * 
     * @return Zend_Cache
     */
    public function getCache ()
    {
        if (null !== $this->_cache) {
            return $this->_cache;
        } else {
            $this->_cache = Zend_Registry::get('Zend_Cache');
            
            return $this->_cache;
        }
    }

    /**
     * 
     * @return Auth_Model_DbTable_Auth
     */
    public function getTable ()
    {
        if (null !== $this->_table) {
            return $this->_table;
        } else {
            $this->_table = new Auth_Model_DbTable_Auth();
            return $this->_table;
        }
    }
}