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
 * @category   Acl
 * @package    Form
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Resource.php 1.0  Jaimie Garner $
 */
class Acl_Form_Element_Select_Resource extends Application_Form_Element_Select
{

    /**
     * (non-PHPdoc)
     * 
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        parent::init();
        
        $AclModelResource = new Acl_Model_Resource();
        $resources = $AclModelResource->findAll();
        
        $this->setLabel($this->translate('Resource'))
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-3');
        
        foreach ($resources as $resource) {
            $this->addMultiOption($resource->acl_resource_id, 
                    $resource->acl_resource_display);
        }
    }
}