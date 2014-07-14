<?php
class Well_Model_DbTable_Well_Comment extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'well_comment';

    /**
     * Contructor
     */
    public function __construct ()
    {
        parent::__construct();

        
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
            $db->query("CREATE TABLE IF NOT EXISTS `well_comment` (
              `id` int(20) NOT NULL AUTO_INCREMENT,
              `user_id` int(20) NOT NULL,
              `well_id` int(20) NOT NULL,
              `well_comment_txt` text NOT NULL,
              `well_comment_private` tinyint(1) NOT NULL,
              `well_comment_created` int(20) NOT NULL,
              `well_comment_deleted` tinyint(1) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`,`well_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
        } catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }

    /**
     * Inserts default rows in the table
     */
    private function insertRows ()
    {
        $db = $this->getDefaultAdapter();
        $db->query("");

        try {} catch (Exception $e) {
            throw new Zend_Exception($e->getMessage());
        }
    }
}