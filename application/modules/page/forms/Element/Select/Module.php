<?php
class Page_Form_Element_Select_Module extends Zend_Form_Element_Select
{
    public function init()
    {
        $PageModelPage = new Page_Model_Page();
        
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');

        $this->setLabel('Module')
        ->setDecorators(array('Decorator'))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-3');

        
        $modules = $PageModelPage->findAllModules();
        foreach($modules as $module) {
            $this->addMultiOption($module->module, ucfirst($module->module));
        }
        
    }
}
