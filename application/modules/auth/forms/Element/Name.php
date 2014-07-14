<?php


class Auth_Form_Element_Name extends Zend_Form_Element_Text
{

    /**
     * (non-PHPdoc)
     *
     * @see Zend_Form_Element::init()
     */
    public function init ()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 
                'decorator');
        
        $this->setLabel('Full Name')
            ->setRequired(true)
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'First Name')
            ->setAttrib('autocomplete', 'off');
        
        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'The first name is required and cannot be empty'
                        ),
                        'breakChainOnFailure' => false
                )
        );
        
        $this->addValidators($validators);
    }
}