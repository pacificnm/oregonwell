<?php
class Well_Form_Create extends Application_Form_Base
{
    public function init() {
        parent::init();
    }
    
    public function import()
    {

        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File')
        ->setDestination(APPLICATION_PATH . '/tmp')
        ->setMaxFileSize(0  )
        ->setRequired(true);
        
        $this->addElement($file);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
    
    public function check()
    {
        $this->addElement(new Well_Form_Element_County('wl_county_code'));
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }
}