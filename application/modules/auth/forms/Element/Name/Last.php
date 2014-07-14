<?php
class Auth_Form_Element_Name_Last extends Zend_Form_Element_Text
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

        $this->setRequired(true)
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('placeholder', 'Last Name')
        ->setAttrib('autocomplete', 'off')
        ->setAttrib('data-size', 'col-lg-4');

        $validators = array(
                array(
                        'validator' => 'NotEmpty',
                        'options' => array(
                                'messages' => 'The last name is required and cannot be empty'
                        ),
                        'breakChainOnFailure' => false
                )
        );

        $this->addValidators($validators);
    }
}