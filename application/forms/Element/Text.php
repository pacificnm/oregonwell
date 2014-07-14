<?php
class Application_Form_Element_Text extends Zend_Form_Element_Text
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms',
                'decorator');
    }
    
    public function translate($string)
    {
        $translate = Zend_Registry::get('Zend_Translate');
        
        $string = $translate->translate($string);
        
        return $string;
    }
}