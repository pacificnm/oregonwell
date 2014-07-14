<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Page_Form_Element_Content_Type extends Zend_Form_Element_Select {

  public function init() {
    $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 'decorator');

    $this->setLabel('Content Type')
        ->setDecorators(array(
          'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-3');

    $this->addMultiOption('it-service', 'IT Service');
    $this->addMultiOption('news', 'News & Events');
    $this->addMultiOption('article', 'Article');
  }

}


