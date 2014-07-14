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
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Theme.php 1.0  Jaimie Garner $
 */
class Config_Form_Element_Theme extends Zend_Form_Element_Select
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 
                'decorator');
        
        $this->setLabel('Theme')
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-3');
        
        $this->addMultiOption('amelia', 'Amelia');
        $this->addMultiOption('cerulean', 'Cerulean');
        $this->addMultiOption('cosmo', 'Cosmo');
        $this->addMultiOption('cyborg', 'Cyborg');
        $this->addMultiOption('flatly', 'Flatly');
        $this->addMultiOption('journal', 'Journal');
        $this->addMultiOption('readable', 'Readable');
        $this->addMultiOption('slate', 'Slate');
        $this->addMultiOption('spacelab', 'Spacelab');
        $this->addMultiOption('united', 'United');
        $this->addMultiOption('yeti', 'Yeti');
    }
}