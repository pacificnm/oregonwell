<?php
class Driller_Model_DbTable_Driller extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'driller';

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
            $db->query("");
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