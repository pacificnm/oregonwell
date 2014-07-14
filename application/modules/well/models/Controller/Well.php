<?php
class Well_Model_Controller_Well extends Application_Model_Controller
{

    private $_wellModel = null;
    private $_createForm = null;
    private $_updateForm = null;
    private $_deleteForm = null;
    private $_wellComementModel = null;
    
    /**
     * @return Well_Model_Well
     */
    protected function getWellModel ()
    {
        if (null !== $this->_wellModel) {
            return $this->_wellModel;
        } else {
            $this->_wellModel = new Well_Model_Well();
            return $this->_wellModel;
        }
    }
    
    /**
     * 
     * @return Well_Model_Well_Comment
     */
    protected function getWellModelComment ()
    {
        if (null !== $this->_wellComementModel) {
            return $this->_wellComementModel;
        } else {
            $this->_wellComementModel = new Well_Model_Well_Comment();
            return $this->_wellComementModel;
        }
    }
    
    
    /**
     * Gets the Create form
     *
     * @return Well_Form_Create
     */
    protected function getCreateForm ()
    {
        if (null !== $this->_createForm) {
            return $this->_createForm;
        } else {
            $this->_createForm = new Well_Form_Create();
            return $this->_createForm;
        }
    }
    
    /**
     * Gets the Update Form
     *
     * @return Well_Form_Update
     */
    protected function getUpdateForm ()
    {
        if (null !== $this->_updateForm) {
            return $this->_updateForm;
        } else {
            $this->_updateForm = new Well_Form_Update();
            return $this->_updateForm;
        }
    }
    
    /**
     * Gets the Delete Form
     *
     * @return Well_Form_Delete
     */
    protected function getDeleteForm ()
    {
        if (null !== $this->_deleteForm) {
            return $this->_deleteForm;
        } else {
            $this->_deleteForm = new Well_Form_Delete();
            return $this->_deleteForm;
        }
    }
}