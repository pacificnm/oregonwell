<?php
class Application_Form_Acl_Element_Select_Resource extends Zend_Form_Element_Select
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');
        
        $ApplicationModelAclResource = new Application_Model_Acl_Resource();
        $resources = $ApplicationModelAclResource->findAll();
        
        $this->setLabel('Resource')
            ->setDecorators(array('Decorator'))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-3');
        
        foreach($resources as $resource) {
            $this->addMultiOption($resource->acl_resource_id, $resource->acl_resource_display);
        }
    }
}