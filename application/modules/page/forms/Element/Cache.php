<?php

class Page_Form_Element_Cache extends Zend_Form_Element_Select {

  public function init() {
    $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 'decorator');

    $this->setLabel('Cache')
        ->setDecorators(array(
          'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-3');

    $this->addMultiOption('1', 'Yes');
    $this->addMultiOption('0', 'No');
  }

}
