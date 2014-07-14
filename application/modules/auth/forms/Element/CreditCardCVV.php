<?php
class Auth_Form_Element_CreditCardCVV extends Zend_Form_Element_Text
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

        $this->setLabel('CVV')
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('autocomplete', 'off')
        ->setAttrib('data-size', 'col-lg-2')
        ->setAttrib('data-label-size', 'col-lg-1')
        ;

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