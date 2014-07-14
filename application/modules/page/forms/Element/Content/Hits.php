<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Page_Form_Element_Content_Hits extends Zend_Form_Element_Text
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
        
        $this->setLabel('Content Hits')
            ->setDecorators(array(
                'Decorator'
        ))
            ->setRequired(true)
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-xs-1');
    }
}

