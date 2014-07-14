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
 * @version    $Id: Controller.php 1.0  Jaimie Garner $
 */
class Auth_Model_Controller extends Application_Model_Controller
{

    /**
     * 
     * @var object Auth_Model_Auth
     */
    private $_authModel = null;

    /**
     * 
     * @var int Auth ID
     */
    private $_authId = null;

    /**
     * 
     * @var object Auth_Form_Create
     */
    private $_createForm = null;

    /**
     * 
     * @var object Auth_Form_Update
     */
    private $_updateForm = null;

    /**
     * 
     * @var object Auth_Form_Delete
     */
    private $_deleteForm = null;

    /**
     * 
     * @var object Auth_Form_Signin
     */
    private $_signInForm = null;

    /**
     * 
     * @var int Page Number
     */
    private $_page = null;

    /**
     *
     * @var object Application_Model_Crypt
     */
    private $_cryptModel = null;
    
    /**
     * Gets the auth_id from request
     * 
     * @throws Zend_Exception
     * @return int
     */
    protected function getAuthId()
    {
        if (null !== $this->_authId) {
            return $this->_authId;
        } else {
            $authId = $this->getRequest()->getParam('auth_id');
            
            if($authId < 1) {
                throw new Zend_Exception('Missing auth_id');
            }
            $this->_authId = $authId;
            return $this->_authId;
        }
    }
    
    /**
     * Gets the signing form object
     * @return object
     */
    protected function getSigninForm ()
    {
        if (null !== $this->_signInForm) {
            return $this->_signInForm;
        } else {
            $model = new Auth_Form_Auth();
            $this->_signInForm = $model->signin();
            return $this->_signInForm;
        }
    }

    /**
     * Gets the Create Form object
     * 
     * @return object Auth_Form_Create
     */
    protected function getCreateForm ()
    {
        if (null !== $this->_createForm) {
            return $this->_createForm;
        } else {
            $this->_createForm = new Auth_Form_Create();
            return $this->_createForm;
        }
    }
    
    /**
     * Gets the Update Form object
     * 
     * @return object Auth_Form_Update
     */
    protected function getUpdateForm ()
    {
        if (null !== $this->_updateForm) {
            return $this->_updateForm;
        } else {
            $this->_updateForm = new Auth_Form_Update();
            return $this->_updateForm;
        }
    }

    /**
     * Gets the Delete form object
     * 
     * @return object Auth_Form_Delete
     */
    protected function getDeleteForm ()
    {
        if (null !== $this->_deleteForm) {
            return $this->_deleteForm;
        } else {
            $this->_deleteForm = new Auth_Form_Delete();
            return $this->_deleteForm;
        }
    }

    /**
     * Gets the Auth Model
     * 
     * @return object Auth_Model_Auth
     */
    protected function getAuthModel ()
    {
        if (null !== $this->_authModel) {
            return $this->_authModel;
        } else {
            $this->_authModel = new Auth_Model_Auth();
            return $this->_authModel;
        }
    }

    /**
     * Gets the Crypt Model object
     * 
     * @return object Application_Model_Crypt
     */
    protected function getCryptModel ()
    {
        if (null !== $this->_cryptModel) {
            return $this->_cryptModel;
        } else {
            $this->_cryptModel = new Application_Model_Crypt();
            return $this->_cryptModel;
        }
    }
}