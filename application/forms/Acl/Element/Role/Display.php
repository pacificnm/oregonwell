<?php
class Application_Form_Acl_Element_Role_Display extends Zend_Form_Element_Text
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');
        
        $this->setLabel('Display')
            ->setRequired(true)
            ->setDecorators(array('Decorator'))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-3');
        
        $validators = array(
                array(
                        'validator'=>'NotEmpty',
                        'options'=>array(
                                'messages'=> 'Display Field is required!'
                        ),
                        'breakChainOnFailure'=>false
                ),
                
        );
        
        $this->addValidators($validators);
    }
}