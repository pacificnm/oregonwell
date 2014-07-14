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
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Base.php 1.0  Jaimie Garner $
 */
class Config_Model_Base extends Application_Model_Base
{

    /**
     *
     * @var object Config_Update_Form
     */
    private $_updateForm = null;

    /**
     * (non-PHPdoc)
     * 
     * @see Application_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Gets the Update Form object
     * 
     * @return object Config_Form_Update
     */
    protected function getUpdateForm ()
    {
        if (null !== $this->_updateForm) {
            return $this->_updateForm;
        } else {
            $this->_updateForm = new Config_Form_Update();
            return $this->_updateForm;
        }
    }
}