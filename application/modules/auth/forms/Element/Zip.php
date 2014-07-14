<?php
class Auth_Form_Element_Zip extends Zend_Form_Element_Text
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

        $this->setLabel('Zip Code')
        ->setRequired(true)
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('autocomplete', 'off')
        ->setAttrib('data-size', 'col-lg-2');

        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'The zip code is required and cannot be empty'
                        ),
                        'breakChainOnFailure' => false
                )
        );

        $this->addValidators($validators);
    }
}