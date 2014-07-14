<?php
class Page_Form_Element_Controller extends Zend_Form_Element_Text
{
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');

        $this->setLabel('Controller Name')
        ->setRequired(true)
        ->setDecorators(array('Decorator'))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-4');

        $validators = array(
                array(
                        'validator'=>'NotEmpty',
                        'options'=>array(
                                'messages'=> 'Controller Name Field is required!'
                        ),
                        'breakChainOnFailure'=>false
                ),
                array(
                        'validator'=>'Alpha',
                        'options'=>array(
                                'messages'=> 'Controller Name must only contain Alpha Numeric characters.'
                        ),
                        'breakChainOnFailure'=>true
                ),
        );

        $this->addValidators($validators);
    }
}
