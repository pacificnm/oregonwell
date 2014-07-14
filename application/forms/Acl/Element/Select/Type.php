<?php
class Application_Form_Acl_Element_Select_Type extends Zend_Form_Element_Select
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');
         
        $this->setLabel('Rule')
        ->setAttrib('class', 'form-control')
        ->setDecorators(array('Decorator'))
        ->setAttrib('data-size', 'col-xs-3');
    
        $this->addMultiOption('allow', 'Allow');
        $this->addMultiOption('deny', 'Deny');

    }
}