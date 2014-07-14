<?php
class Auth_Form_Element_CreditCardNumber extends Zend_Form_Element_Text
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

        $this->setLabel('Card Number')
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('autocomplete', 'off')
        ->setAttrib('data-size', 'col-lg-4');

        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'The Credit Card Number is required'
                        ),
                        'breakChainOnFailure' => false
                )
        );

        $this->addValidators($validators);
    }
}