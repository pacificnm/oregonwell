<?php
class Application_Form_Acl_Element_Select_Child extends Zend_Form_Element_Select
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');

        $ApplicationModelAclRole = new Application_Model_Acl_Role();
        $roles = $ApplicationModelAclRole->findAll();
         
        $this->setLabel('Inherents')
        ->setAttrib('class', 'form-control')
        ->setDecorators(array('Decorator'))
        ->setAttrib('data-size', 'col-xs-3');

        foreach($roles as $role) {
            $this->addMultiOption($role->acl_role_id, $role->acl_role_display);
        }

    }
}