<?php
class Well_Model_DbTable_Well extends Zend_Db_Table_Abstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract
     */
    protected $_name = 'well';

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
            $db->query("CREATE TABLE IF NOT EXISTS `well` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `wl_county_code` varchar(20) DEFAULT NULL,
  `wl_nbr` varchar(20) DEFAULT NULL,
  `wl_version` varchar(20) DEFAULT NULL,
  `well_tag_nbr` varchar(20) DEFAULT NULL,
  `name_last` varchar(60) DEFAULT NULL,
  `name_first` varchar(60) DEFAULT NULL,
  `name_mi` varchar(20) DEFAULT NULL,
  `name_company` varchar(60) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `state` varchar(60) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `type_of_log` varchar(20) DEFAULT NULL,
  `depth_first_water` int(8) DEFAULT NULL,
  `depth_drilled` int(8) DEFAULT NULL,
  `completed_depth` int(8) DEFAULT NULL,
  `post_static_water_level` int(8) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `complete_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `startcard_nbr` varchar(20) DEFAULT NULL,
  `bonded_license_nbr` text,
  `work_new` tinyint(1) DEFAULT NULL,
  `work_abandonment` tinyint(1) DEFAULT NULL,
  `work_deepening` tinyint(1) DEFAULT NULL,
  `work_alteration` tinyint(1) DEFAULT NULL,
  `work_conversion` tinyint(1) DEFAULT NULL,
  `work_other` tinyint(1) DEFAULT NULL,
  `use_domestic` tinyint(1) DEFAULT NULL,
  `use_irrigation` tinyint(1) DEFAULT NULL,
  `use_community` tinyint(1) DEFAULT NULL,
  `use_livestock` tinyint(1) DEFAULT NULL,
  `use_industrial` tinyint(1) DEFAULT NULL,
  `use_injection` tinyint(1) DEFAULT NULL,
  `use_thermal` tinyint(1) DEFAULT NULL,
  `use_dewatering` tinyint(1) DEFAULT NULL,
  `use_piezometer` tinyint(1) DEFAULT NULL,
  `use_other` tinyint(1) DEFAULT NULL,
  `township` varchar(20) DEFAULT NULL,
  `township_char` varchar(10) DEFAULT NULL,
  `range` varchar(20) DEFAULT NULL,
  `range_char` varchar(20) DEFAULT NULL,
  `sctn` varchar(20) DEFAULT NULL,
  `qtr160` varchar(20) DEFAULT NULL,
  `qtr40` int(20) DEFAULT NULL,
  `tax_lot` varchar(20) DEFAULT NULL,
  `street_of_well` varchar(100) DEFAULT NULL,
  `location_county` varchar(60) DEFAULT NULL,
  `longitude` varchar(60) DEFAULT NULL,
  `latitude` varchar(60) DEFAULT NULL,
  `bonded_name_last` varchar(100) DEFAULT NULL,
  `bonded_name_first` varchar(100) NOT NULL,
  `created` int(20) NOT NULL,
  PRIMARY KEY (`id`)
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