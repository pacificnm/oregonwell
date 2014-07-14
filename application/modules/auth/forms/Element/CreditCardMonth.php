<?php
class Auth_Form_Element_CreditCardMonth extends Zend_Form_Element_Select
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

        $this->setLabel('Expiration')
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-lg-2');

        $this->addMultiOption('1', 'January');
        $this->addMultiOption('2', 'Februrary');
        $this->addMultiOption('3', 'March');
        $this->addMultiOption('4', 'April');
        $this->addMultiOption('5', 'May');
        $this->addMultiOption('6', 'June');
        $this->addMultiOption('7', 'July');
        $this->addMultiOption('8', 'August');
        $this->addMultiOption('9', 'September');
        $this->addMultiOption('10', 'October');
        $this->addMultiOption('11', 'November');
        $this->addMultiOption('12', 'December');
       
    }
}