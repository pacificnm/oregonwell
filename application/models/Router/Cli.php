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
 * @category   Application
 * @package    Model
 * @subpackage Router
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Cli.php 1.0  Jaimie Garner $
 */
class Application_Model_Router_Cli extends Zend_Controller_Router_Abstract implements 
        Zend_Controller_Router_Interface
{

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Interface::route()
     */
    public function route (Zend_Controller_Request_Abstract $dispatcher)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Interface::assemble()
     */
    public function assemble ($userParams, $name = null, $reset = false, $encode = true)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Abstract::getFrontController()
     */
    public function getFrontController ()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Abstract::setFrontController()
     */
    public function setFrontController (Zend_Controller_Front $controller)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Abstract::setParam()
     */
    public function setParam ($name, $value)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Abstract::setParams()
     */
    public function setParams (array $params)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Controller_Router_Abstract::getParam()
     */
    public function getParam ($name)
    {}

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Router_Abstract::getParams()
     */
    public function getParams ()
    {}

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Controller_Router_Abstract::clearParams()
     */
    public function clearParams ($name = null)
    {}

    /**
     * Adds A route
     */
    public function addRoute ()
    {}

    /**
     * Sets Global Param
     */
    public function setGlobalParam ()
    {}

    /**
     * Adds a Config
     */
    public function addConfig ()
    {}
    // TODO: possibly some additional methods should be added
}
