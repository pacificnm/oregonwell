<?php

class Page_Form_Delete extends Application_Form_Base {

  public function init() {
    parent::init();
  }

  public function module() {
    $this->addElement(new Application_Form_Element_Delete('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function page() {
    $this->addElement(new Application_Form_Element_Delete('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

    return $this;
  }

  public function content() {
    $this->addElement(new Application_Form_Element_Delete('submit'));

    $this->addElement(new Application_Form_Element_Hash('hash'));

     return $this;
  }

}
