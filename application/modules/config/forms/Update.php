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
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Update.php 1.0  Jaimie Garner $
 */
class Config_Form_Update extends Application_Form_Base
{

    /**
     * (non-PHPdoc)
     * 
     * @see Application_Form_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Updates the Application Config
     * 
     * @param object $config
     *            Zend_Config_Xml
     * @return Config_Form_Update
     */
    public function config ($config)
    {
        $element = new Config_Form_Element_Name('name');
        $element->setValue($config->name);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Version('version');
        $element->setValue($config->version);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Installed('installed');
        $element->setValue($config->installed);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Timezone('time_zone');
        $element->setValue($config->time_zone);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Language('language');
        $element->setValue($config->language);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Theme('theme');
        $element->setValue($config->theme);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Debug('debug');
        $element->setValue($config->debug_enabled);
        $this->addElement($element);
        
        $this->addDisplayGroup(
                array(
                        'name',
                        'version',
                        'installed',
                        'time_zone',
                        'language',
                        'theme',
                        'debug'
                ), 'Application', 
                array(
                        'legend' => 'Application'
                ));
        
        // Database
        $element = new Config_Form_Element_Host('host');
        $element->setValue($config->db->params->host);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Username('username');
        $element->setValue($config->db->params->username);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Password('password');
        $element->setValue($config->db->params->password);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Dbname('dbname');
        $element->setValue($config->db->params->dbname);
        $this->addElement($element);
        
        $this->addDisplayGroup(
                array(
                        'host',
                        'username',
                        'password',
                        'dbname'
                ), 'Database', 
                array(
                        'legend' => 'Database'
                ));
        
        
        
        // Cache
        $element = new Config_Form_Element_Cache('cache_enabled');
        $element->setValue($config->cache->enabled);
        $this->addElement($element);
        
        $element = new Config_Form_Element_Cachedir('cache_directory');
        $element->setValue($config->cache->directory);
        $this->addElement($element);
        
        $this->addDisplayGroup(
                array(
                        'cache_enabled',
                        'cache_directory'
                ), 'Cache', 
                array(
                        'legend' => 'Cache'
                ));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}