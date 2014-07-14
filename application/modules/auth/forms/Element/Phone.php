<?php
class Auth_Form_Element_Phone extends Zend_Form_Element_Text
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

        $this->setLabel('Phone Number')
        ->setRequired(true)
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('autocomplete', 'off')
        ->setAttrib('data-size', 'col-lg-3');

        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'The Phone Number is required and cannot be empty'
                        ),
                        'breakChainOnFailure' => false
                )
        );

        $this->addValidators($validators);
    }
}