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
 * @version    $Id: Update.php 1.0  Jaimie Garner $
 */
class Page_Form_Update extends Application_Form_Base {

  /**
   * (non-PHPdoc)
   * 
   * @see Application_Form_Base::init()
   */
  public function init() {
    parent::init();
  }

  /**
   * Creates the update module form
   *
   * @return Page_Form_Update
   */
  public function module() {
    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  /**
   * Creates the Update Page form
   * 
   * @param object $page            
   * @return Page_Form_Update
   */
  public function page($page) {
    $element = new Page_Form_Element_Select_Module('module_name');
    $element->setValue($page->module);
    $this->addElement($element);

    $element = new Page_Form_Element_Controller('controller_name');
    $element->setValue($page->controller);
    $this->addElement($element);

    $element = new Page_Form_Element_Action('action_name');
    $element->setValue($page->action);
    $this->addElement($element);

    $element = new Acl_Form_Element_Select_Resource('acl_resource_id');
    $element->setValue($page->acl_resource_id);
    $this->addElement($element);

    $element = new Page_Form_Element_Breadcrumb('breadcrumb');
    $element->setValue($page->breadcrumb);
    $this->addElement($element);

    $element = new Page_Form_Element_Cache('cache');
    $element->setValue($page->cache);
    $this->addElement($element);

    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  /**
   * Creats the Update Meta form
   * 
   * @param object $meta            
   * @return Page_Form_Update
   */
  public function meta($meta) {
    $element = new Page_Form_Element_Language('language');
    $element->setValue($meta->language);
    $this->addElement($element);

    $element = new Page_Form_Element_Page_Title('page_title');
    $element->setValue($meta->page_title);
    $this->addElement($element);

    $element = new Page_Form_Element_Meta_Title('meta_title');
    $element->setValue($meta->meta_title);
    $this->addElement($element);

    $element = new Page_Form_Element_Meta_Description('meta_description');
    $element->setValue($meta->meta_description);
    $this->addElement($element);

    $element = new Page_Form_Element_Meta_Keyword('meta_keyword');
    $element->setValue($meta->meta_keyword);
    $this->addElement($element);

    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function content($content) {

    
    $element = new Page_Form_Element_Content_Type('content_type');
    $element->setValue($content->content_type);
    $this->addElement($element);

    $element = new Page_Form_Element_Content_Title('content_title');
    $element->setValue($content->content_title);
    $this->addElement($element);

    $element = new Page_Form_Element_Content_Body('content_body');
    $element->setValue($content->content_body);
    $this->addElement($element);

    $element = new Page_Form_Element_Content_Description('content_description');
    $element->setValue($content->content_description);
    $this->addElement($element);

    $element = new Page_Form_Element_Content_Keyword('content_keyword');
    $element->setValue($content->content_keyword);
    $this->addElement($element);

    $element = new Page_Form_Element_Content_Hits('content_hits');
    $element->setValue($content->content_hits);
    $this->addElement($element);
    
    $this->addElement(new Application_Form_Element_Save('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

}
