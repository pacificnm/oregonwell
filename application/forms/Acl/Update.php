<?php
class  Application_Form_Acl_Update extends Application_Form_Base
{
    public function int()
    {

    }

    public function resource($resource)
    {
        $element = new Application_Form_Acl_Element_Resource_Name('acl_resource_name');
        $element->setValue($resource->acl_resource_name);
        $this->addElement($element);
        
        $element = new Application_Form_Acl_Element_Resource_Display('acl_resource_display');
        $element->setValue($resource->acl_resource_display);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    public function role($role)
    {
        $element = new Application_Form_Acl_Element_Role_Name('acl_role_name');
        $element->setValue($role->acl_role_name);
        $this->addElement($element);
        
        $element = new Application_Form_Acl_Element_Role_Display('acl_role_display');
        $element->setValue($role->acl_role_display);
        $this->addElement($element);
        
        $element = new Application_Form_Acl_Element_Select_Child('acl_role_child');
        $element->setValue($role->acl_role_child);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

    public function rule($rule)
    {
        $element = new Application_Form_Acl_Element_Select_Role('acl_role_id');
        $element->setValue($rule->acl_role_id);
        $this->addElement($element);
        
        $element = new Application_Form_Acl_Element_Select_Type('acl_type');
        $element->setValue($rule->acl_type);
        $this->addElement($element);
        
        $element = new Application_Form_Acl_Element_Select_Resource('acl_resource_id');
        $element->setValue($rule->acl_resource_id);
        $this->addElement($element);
        
        $this->addElement(new Application_Form_Element_Save('submit'));
        
        $this->addElement(new Application_Form_Element_Hash('hash'));
        
        return $this;
    }

}