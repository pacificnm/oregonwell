<?php
class Page_Model_DbTable_Content extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'content';

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
                $db->query( "CREATE TABLE IF NOT EXISTS `content` (
      `content_id` int(11) NOT NULL AUTO_INCREMENT,
      `content_type` varchar(60) NOT NULL,
      `content_name` varchar(255) NOT NULL,
      `content_body` longtext NOT NULL,
      `content_description` varchar(255) NOT NULL,
      `content_keyword` varchar(255) NOT NULL,
      `content_title` varchar(255) NOT NULL,
      `content_active` int(3) NOT NULL,
      `content_hits` int(11) NOT NULL,
      `content_created` int(11) NOT NULL,
      PRIMARY KEY (`content_id`)
    ) ENGINE=InnoDB");
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
    
    private function insertRows ()
    {
        
    }
}