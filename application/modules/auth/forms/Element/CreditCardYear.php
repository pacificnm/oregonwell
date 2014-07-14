<?php
class Auth_Form_Element_CreditCardYear extends Zend_Form_Element_Select
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

        $this->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-lg-2');

        $startYear = date("Y"); 
        $endYear = $startYear + 10;
        for($i = $startYear; $i <= $endYear; $i++) {
            $this->addMultiOption($i, $i);
        }

    }
}