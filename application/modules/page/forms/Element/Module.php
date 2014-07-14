<?php
class Page_Form_Element_Module extends Zend_Form_Element_Text
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');

        $this->setLabel('Module Name')
        ->setRequired(true)
        ->setDecorators(array('Decorator'))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-4');

        $validators = array(
                array(
                        'validator'=>'NotEmpty',
                        'options'=>array(
                                'messages'=> 'Module Name Field is required!'
                        ),
                        'breakChainOnFailure'=>false
                ),
                array(
                        'validator'=>'Alpha',
                        'options'=>array(
                                'messages'=> 'Module Name must only contain Alpha Numeric characters.'
                        ),
                        'breakChainOnFailure'=>true
                ),
        );

        $this->addValidators($validators);
    }
}
