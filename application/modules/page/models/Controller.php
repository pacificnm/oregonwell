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
 * @category   Page
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Controller.php 1.0  Jaimie Garner $
 */
class Page_Model_Controller extends Application_Model_Controller
{

    /**
     * 
     * @var Page_Model_Page
     */
    private $_pageModel = null;

    /**
     * @var Page_Model_Content
     */
    private $_contentModel = null;
    
    private $_contentId = null;
    
    /**
     * 
     * @var Page_Model_Page_Meta
     */
    private $_pageMetaModel = null;

    /**
     * 
     * @var int
     */
    private $_pageId = null;

    /**
     * 
     * @var int
     */
    private $_pageMetaId = null;
    
    /**
     * 
     * @var Page_Form_Create
     */
    private $_createForm = null;

    /**
     * 
     * @var Page_Form_Update
     */
    private $_updateForm = null;

    /**
     * 
     * @var Page_Form_Delete
     */
    private $_deleteForm = null;

    /**
     * (non-PHPdoc)
     * @see Application_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Gets the Page Id from the request
     * 
     * @throws Zend_Exception
     * @return int page_id
     */
    protected function getPageId ()
    {
        if (null !== $this->_pageId) {
            return $this->_pageId;
        } else {
            $pageId = $this->getRequest()->getParam('page_id');
            
            if ($pageId < 1) {
                throw new Zend_Exception('Missing page_id');
            }
            $this->_pageId = $pageId;
            return $this->_pageId;
        }
    }

    protected function getContentId ()
    {
        if (null !== $this->_contentId) {
            return $this->_contentId;
        } else {
            $contentId = $this->getRequest()->getParam('content_id');
            
            if ($contentId < 1) {
                throw new Zend_Exception('Missing content_id');
            }
            $this->_contentId = $contentId;
            return $this->_contentId;
        }
    }
    
    /**
     * Gets the Page Meta Id from the request
     * 
     * @throws Zend_Exception
     * @return int page_meta_id
     */
    protected function getPageMetaId()
    {
        if (null !== $this->_pageMetaId) {
            return $this->_pageMetaId;
        } else {
            $pageMetaId = $this->getRequest()->getParam('page_meta_id');
        
            if ($pageMetaId < 1) {
                throw new Zend_Exception('Missing page_id');
            }
            $this->_pageMetaId = $pageMetaId;
            return $this->_pageMetaId;
        }
    }
    
    /**
     * Gets the page model object
     * 
     * @return Page_Model_Page
     */
    protected function getPageModel ()
    {
        if (null !== $this->_pageModel) {
            return $this->_pageModel;
        } else {
            $this->_pageModel = new Page_Model_Page();
            return $this->_pageModel;
        }
    }
    
    /**
     * 
     * @return Page_Model_Conetent
     */
    protected function getContentModel ()
    {
        if (null !== $this->_contentModel) {
            return $this->_contentModel;
        } else {
            $this->_contentModel = new Page_Model_Content();
            return $this->_contentModel;
        }
    }

    /**
     * Gets the page_meta model object
     * 
     * @return Page_Model_Page_Meta
     */
    protected function getPageMetaModel ()
    {
        if (null !== $this->_pageMetaModel) {
            return $this->_pageMetaModel;
        } else {
            $this->_pageMetaModel = new Page_Model_Page_Meta();
            return $this->_pageMetaModel;
        }
    }

    /**
     * Gets the Create form
     * 
     * @return Page_Form_Create
     */
    protected function getCreateForm ()
    {
        if (null !== $this->_createForm) {
            return $this->_createForm;
        } else {
            $this->_createForm = new Page_Form_Create();
            return $this->_createForm;
        }
    }

    /**
     * Gets the Update Form
     * 
     * @return Page_Form_Update
     */
    protected function getUpdateForm ()
    {
        if (null !== $this->_updateForm) {
            return $this->_updateForm;
        } else {
            $this->_updateForm = new Page_Form_Update();
            return $this->_updateForm;
        }
    }

    /**
     * Gets the Delete Form
     * 
     * @return Page_Form_Delete
     */
    protected function getDeleteForm ()
    {
        if (null !== $this->_deleteForm) {
            return $this->_deleteForm;
        } else {
            $this->_deleteForm = new Page_Form_Delete();
            return $this->_deleteForm;
        }
    }
}