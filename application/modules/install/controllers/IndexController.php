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
 * @category   Install
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: IndexController.php 1.0  Jaimie Garner $
 */
class Install_IndexController extends Zend_Controller_Action
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Action::init()
     */
    public function init ()
    {
        $config = Zend_Registry::get('Application_Config');
        
        if ($config->installed == 'true') {
            $this->redirect('/index');
        }
        
        $this->view->appConfig = $config;
    }

    /**
     * Index action
     */
    public function indexAction ()
    {
        $formModel = new Install_Form_Create();
        $form = $formModel->application();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $configPath = APPLICATION_PATH . '/configs/config.xml';
                $config = new Zend_Config_Xml($configPath, null, 
                        array(
                                'skipExtends' => true,
                                'allowModifications' => true
                        ));
                
                $name = $this->getParam('name');
                $version = $this->getParam('version');
                $installed = $this->getParam('installed');
                $timeZone = $this->getParam('time_zone');
                $language = $this->getParam('language');
                $theme = $this->getParam('theme');
                
                $config->name = $name;
                $config->version = $version;
                $config->installed = $installed;
                $config->time_zone = $timeZone;
                $config->language = $language;
                $config->theme = $theme;
                
                $writer = new Zend_Config_Writer_Xml(
                        array(
                                'config' => $config,
                                'filename' => $configPath
                        ));
                
                $writer->write();
                
                $this->redirect('/install/index/database');
            }
        }
        
        $this->view->form = $form;
    }

    /**
     * database action
     */
    public function databaseAction ()
    {
        $formModel = new Install_Form_Create();
        $form = $formModel->database();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $configPath = APPLICATION_PATH . '/configs/config.xml';
                $config = new Zend_Config_Xml($configPath, null, 
                        array(
                                'skipExtends' => true,
                                'allowModifications' => true
                        ));
                
                $host = $this->getParam('host');
                $username = $this->getParam('username');
                $password = $this->getParam('password');
                $dbname = $this->getParam('dbname');
                
                $config->db->params->host = $host;
                $config->db->params->username = $username;
                $config->db->params->password = $password;
                $config->db->params->dbname = $dbname;
                
                $writer = new Zend_Config_Writer_Xml(
                        array(
                                'config' => $config,
                                'filename' => $configPath
                        ));
                
                $writer->write();
                
                // create database
                $InstallModelBase = new Install_Model_Base();
                $InstallModelBase->createDatabase();
                
                //$this->redirect('/install/index/admin');
            }
        }
        $this->view->form = $form;
    }

    /**
     * Admin action
     */
    public function adminAction ()
    {
        $formModel = new Install_Form_Create();
        $form = $formModel->admin();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $AuthModelAuth = new Auth_Model_Auth();
                $ApplicationModelCrypt = new Application_Model_Crypt();
                
                $username = $this->getParam('username');
                $email = $this->getParam('email');
                $password = $ApplicationModelCrypt->crypt(
                        $this->getParam('password'));
                $name = $this->getParam('name');
                $aclRoleId = $this->getParam('acl_role_id');
                
                $authId = $AuthModelAuth->save($username, $email, $password, 
                        $name, $aclRoleId);
                
                $this->redirect('/install/index/complete');
            }
        }
        $this->view->form = $form;
    }

    /**
     * complete action
     */
    public function completeAction ()
    {
        $configPath = APPLICATION_PATH . '/configs/config.xml';
        $config = new Zend_Config_Xml($configPath, null, 
                array(
                        'skipExtends' => true,
                        'allowModifications' => true
                ));
        
        $config->installed = 'true';
        $config->install_date = time();
        
        $writer = new Zend_Config_Writer_Xml(
                array(
                        'config' => $config,
                        'filename' => $configPath
                ));
        
        $writer->write();
    }
}