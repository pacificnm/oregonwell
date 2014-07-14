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
 * @category   Navigation
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Controller.php 1.0  Jaimie Garner $
 */
class Navigation_Model_Controller extends Application_Model_Controller
{

    private $_configFile = null;

    private $_nagigationModel = null;

    private $_navigationId = null;

    private $_parentId = null;
    
    public function init ()
    {
        parent::init();
    }

    public function getNavigationId()
    {
        if (null !== $this->_navigationId) {
            return $this->_navigationId;
        } else {
            $id = $this->getParam('navigation_id');
        
            if (empty($id)) {
                throw new Zend_Exception('missing param navigation_id');
            }
        
            $this->_navigationId = $id;
            return $this->_navigationId;
        }
    }
    
    public function getParentId()
    {
        if (null !== $this->_parentId) {
            return $this->_parentId;
        } else {
            $id = $this->getParam('parent_id');
        
            if (empty($id)) {
                $id = 0;
            }
        
            $this->_parentId = $id;
            return $this->_parentId;
        }
    }
    
    public function getConfigFile()
    {
        if (null !== $this->_configFile) {
            return $this->_configFile;
        } else {
            $configFile = APPLICATION_PATH . '/configs/navigation.xml';
        
            $this->_configFile = $configFile;
            return $this->_configFile;
        }
    }
    
    public function getNavigationModel()
    {
        if (null !== $this->_nagigationModel) {
            return $this->_nagigationModel;
        } else {
            $this->_nagigationModel = new Navigation_Model_Navigation();
            return $this->_nagigationModel;
        }
    }
    
    
}