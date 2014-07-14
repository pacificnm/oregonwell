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
 * @category   Config
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: IndexController.php 1.0  Jaimie Garner $
 */
class Config_IndexController extends Config_Model_Controller
{

    /**
     * (non-PHPdoc)
     * 
     * @see Config_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Index Action
     */
    public function indexAction ()
    {
        $this->view->config = $this->getAppConfig();
    }

    /**
     * Update Action
     */
    public function updateAction ()
    {
        $form = $this->getUpdateForm()->config($this->getAppConfig());
        
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
                $debug = $this->getParam('debug');
                $host = $this->getParam('host');
                $username = $this->getParam('username');
                $password = $this->getParam('password');
                $dbname = $this->getParam('dbname');
                $movieDir = $this->getParam('movie_dir');
                $movieDb = $this->getParam('movie_db');
                $apiKey = $this->getParam('api_key');
                $cacheEnabled = $this->getParam('cache_enabled');
                $cacheDirectory = $this->getParam('cache_directory');
                
                $config->name = $name;
                $config->version = $version;
                $config->installed = $installed;
                $config->time_zone = $timeZone;
                $config->language = $language;
                $config->theme = $theme;
                $config->debug_enabled = $debug;
                
                $config->db->params->host = $host;
                $config->db->params->username = $username;
                $config->db->params->password = $password;
                $config->db->params->dbname = $dbname;
                
                $config->movie_dir = $movieDir;
                
                $config->movie_db->enabled = $movieDb;
                $config->movie_db->api_key = $apiKey;
                
                $config->cache->enabled = $cacheEnabled;
                $config->cache->directory = $cacheDirectory;
                
                $writer = new Zend_Config_Writer_Xml(
                        array(
                                'config' => $config,
                                'filename' => $configPath
                        ));
                
                $writer->write();
                
                $this->setFlashSuccess('Configuration was saved.');
                
                $this->redirect('/config/index');
            }
        }
        
        $this->view->form = $form;
    }
}
