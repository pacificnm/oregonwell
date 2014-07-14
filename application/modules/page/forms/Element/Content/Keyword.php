<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Page_Form_Element_Content_Keyword extends Zend_Form_Element_Textarea
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
        
        $this->setLabel('Meta Keywords')
            ->setDecorators(array(
                'Decorator'
        ))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-4')
            ->setAttrib('rows', 4);
    }
}
