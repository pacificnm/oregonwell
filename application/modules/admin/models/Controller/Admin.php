<?php
class Admin_Model_Controller_Admin extends Application_Model_Controller
{
	#########################################################
	# Models                                                #
	#########################################################
	
	/**
	 *
	 * @var Vendor_Model_Vendor
	 */
	private $_vendorModel = null;
	
	/**
	 *
	 * @var Vendor_Model_Vendor_Bill
	 */
	private $_billModel = null;
	
	/**
	 *
	 * @var Vendor_Model_Vendor_Payment
	 */
	private $_paymentModel = null;
	
	/**
	 *
	 * @var Workorder_Model_Time
	 */
	private $_workorderTime = null;
	
	
	/**
	 *
	 * @return Vendor_Model_Vendor
	 */
	public function getVendorModel()
	{
		if (null !== $this->_vendorModel) {
			return $this->_vendorModel;
		} else {
			$this->_vendorModel = new Vendor_Model_Vendor();
			return $this->_vendorModel;
		}
	}
	
	/**
	 *
	 * @return Vendor_Model_Vendor_Bill
	 */
	public function getBillModel()
	{
		if (null !== $this->_billModel) {
			return $this->_billModel;
		} else {
			$this->_billModel = new Vendor_Model_Vendor_Bill();
			return $this->_billModel;
		}
	}
	
	/**
	 *
	 * @return Vendor_Model_Vendor_Payment
	 */
	public function getPaymentModel()
	{
		if (null !== $this->_paymentModel) {
			return $this->_paymentModel;
		} else {
			$this->_paymentModel = new Vendor_Model_Vendor_Payment();
			return $this->_paymentModel;
		}
	}
	
	/**
	 *
	 * @return Workorder_Model_Time
	 */
	public function getWorkorderTimeModel()
	{
	    if (null !== $this->_workorderTime) {
	        return $this->_workorderTime;
	    } else {
	        $this->_workorderTime = new Workorder_Model_Time();
	        return $this->_workorderTime;
	    }
	}
	
	#########################################################
	# ID                                                    #
	#########################################################
	
	/**
	 *
	 * @var number
	 */
	private $_vendorId = null;
	
	/**
	 *
	 * @var number
	 */
	private $_billId = null;
	
	/**
	 *
	 * @throws Zend_Exception
	 * @return number
	 */
	public function getVendorId()
	{
		if (null !== $this->_vendorId) {
			return $this->_vendorId;
		} else {
			$id = $this->getParam('vendor_id');
	
			if (empty($id)) {
				throw new Zend_Exception('missing param vendor_id');
			}
	
			$this->_vendorId = $id;
			return $this->_vendorId;
		}
	}
	
	/**
	 *
	 * @throws Zend_Exception
	 * @return number
	 */
	public function getBillId()
	{
		if (null !== $this->_billId) {
			return $this->_billId;
		} else {
			$id = $this->getParam('vendor_bill_id');
	
			if (empty($id)) {
				throw new Zend_Exception('missing param vendor_bill_id');
			}
	
			$this->_billId = $id;
			return $this->_billId;
		}
	}
}
