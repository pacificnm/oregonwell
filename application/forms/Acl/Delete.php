<?php
class  Application_Form_Acl_Delete extends Application_Form_Base
{
    public function int()
    {

    }

    public function resource()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        return $this;
    }

    public function role()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        return $this;
    }

    public function rule()
    {
        $this->addElement(new Application_Form_Element_Delete('submit'));
        return $this;
    }

}