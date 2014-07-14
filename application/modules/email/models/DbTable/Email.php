<?php

class Email_Model_DbTable_Email extends Zend_Db_Table_Abstract {

  /**
   *
   * @var Zend_Db_Table_Abstract
   */
  protected $_name = 'email';

  /**
   * Contructor
   */
  public function __construct() {
    parent::__construct();

    $this->verify();
  }

  /**
   * Verifies the Database Table Exists
   *
   * @throws Zend_Exception
   */
  private function verify() {
    // test if Database exists
    try {
      $db = $this->getDefaultAdapter();
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }

    // test if table exists
    try {
      $result = $db->describeTable($this->_name);

      if (empty($result)) {
        $this->createTable();
        $this->insertRows();
      }
    }
    catch (Exception $e) {
      $this->createTable();
      $this->insertRows();
    }
  }

  /**
   * Creates the Database Table
   *
   * @throws Zend_Exception
   */
  private function createTable() {
    $db = $this->getDefaultAdapter();

    try {
      $db->query("CREATE TABLE IF NOT EXISTS `email` (
        `email_id` int(11) NOT NULL AUTO_INCREMENT,
        `employee_id` int(11) NOT NULL,
        `client_id` int(11) NOT NULL,
        `email_date` int(11) NOT NULL,
        `email_to` varchar(200) NOT NULL,
        `email_subject` varchar(255) NOT NULL,
        `email_body` text NOT NULL,
        PRIMARY KEY (`email_id`),
        KEY `client_id` (`client_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
      ");
    }
    catch (Exception $e) {
      throw new Zend_Exception($e->getMessage());
    }
  }
  
   /**
     * Inserts default rows in the table
     */
    private function insertRows ()
    {
        return true;
    }

}

