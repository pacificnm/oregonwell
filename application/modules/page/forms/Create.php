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
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Create.php 1.0  Jaimie Garner $
 */
class Page_Form_Create extends Application_Form_Base {

  public function init() {
    parent::init();
  }

  public function module() {
    $this->addElement(new Page_Form_Element_Module('module_name'));

    $this->addElement(
        new Acl_Form_Element_Select_Resource(
        'acl_resource_id'));

    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function page() {
    $this->addElement(new Page_Form_Element_Select_Module('module_name'));

    $this->addElement(new Page_Form_Element_Controller('controller_name'));

    $this->addElement(new Page_Form_Element_Action('action_name'));

    $this->addElement(
        new Acl_Form_Element_Select_Resource(
        'acl_resource_id'));

    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function meta() {
    $this->addElement(new Page_Form_Element_Language('language'));

    $this->addElement(new Page_Form_Element_Page_Title('page_title'));

    $this->addElement(new Page_Form_Element_Meta_Title('meta_title'));

    $this->addElement(new Page_Form_Element_Meta_Description('meta_description'));

    $this->addElement(new Page_Form_Element_Meta_Keyword('meta_keyword'));

    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function content() 
  {
    $this->addElement(new Page_Form_Element_Content_Type('content_type'));
    
    $this->addElement(new Page_Form_Element_Content_Title('content_title'));

    $this->addElement(new Page_Form_Element_Content_Body('content_body'));
    
    $this->addElement(new Page_Form_Element_Content_Description('content_description'));
    
    $this->addElement(new Page_Form_Element_Content_Keyword('content_keyword'));
    
    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

}
