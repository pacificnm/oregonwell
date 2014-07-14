<?php

/**
 * MyFlix
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pacificnm.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to pacificnm@gmail.com so we can send you a copy immediately.
 *
 * @category   Application
 * @package    Form
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Decorator.php 1.0  Jaimie Garner $
 */
class Application_Form_Decorator extends Zend_Form_Decorator_Abstract
{
    
    /**
     * Builds the label
     * @return Ambigous <string>
     */
    public function buildLabel()
    {
        $element = $this->getElement();
   
        $label = $element->getLabel();
        
        if ($translator = $element->getTranslator()) {
            $label = $translator->translate($label);
        }
            
        if(!empty($label)) {
            if ($element->isRequired() && $element->helper != 'formHidden') {
                $label .= ' <span class="help-inline text-danger">*</span> ';
            }
        }   
        return $label;
    }
    
    
    /**
     * Builds Input field
     */
    public function buildInput()
    {
        $element = $this->getElement();
        $helper  = $element->helper;
        return $element->getView()->$helper(
                $element->getName(),
                $element->getValue(),
                $element->getAttribs(),
                $element->options
        );
    }
    
    /**
     * 
     * @return string
     */
    public function buildErrors()
    {
        $element  = $this->getElement();
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
    
        list($key, $error) = each($messages);
        return '<small class="help-block">' . $error . '</small>';
    }
    
    /**
     * 
     * @return string
     */
    public function buildDescription()
    {
        $element = $this->getElement();
        $desc    = $element->getDescription();
        if (empty($desc)) {
            return '';
        }
        return '<p class="help-block">' . $desc . '</p>' . "\n";
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend_Form_Decorator_Abstract::render()
     */
    public function render($content)
    {
        $element = $this->getElement();
        if (!$element instanceof Zend_Form_Element) {
            return $content;
        }
        if (null === $element->getView()) {
            return $content;
        }
    
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $label     = $this->buildLabel();
        $input     = $this->buildInput();
        $errors    = $this->buildErrors();
        $desc      = $this->buildDescription();
    
          
        if($errors) {
            $output = '<div class="form-group has-error">'."\n";
        } else {
          $output = '';
        }
         
        $dataSize = $element->getAttrib('data-size');
        if(empty($dataSize)) $dataSize = 'col-lg-5';
        
        $labelSize = $element->getAttrib('data-label-size');
        if(empty($labelSize)) $labelSize = 'col-lg-3';
        
        
        $dataToggle = $element->getAttrib('data-toggle');
        if($label) {
            
            $output .='<label class="'.$labelSize.' control-label" >' . $label . '</label>';
        }
        $output .= '<div class="'.$dataSize.'">';
        
        if($dataToggle =='time-picker') {
            $output .= '<div class="input-group bootstrap-timepicker">';
        }
        
        if($dataToggle == 'date-picker') {
            $output .= '<div class="input-group bootstrap-datepicker">';
        }

        if($dataToggle == 'money') {
            //$locale = Zend_Auth::getInstance()->getIdentity()->auth_locale;
            $locale = 'en_US';
            $currency = new Zend_Currency($locale);
            
            $output .='<div class="input-group">
              <span class="input-group-addon text-primary">'.$currency->getSymbol().'</span>';
        }
        
        $output .= $input;
        
        if($dataToggle == 'money') {
            $output .= '</div>';
        }
        
        
        if($dataToggle =='time-picker') {
            $output .='<span class="input-group-addon"><i class="glyphicon glyphicon-time text-primary"></i></span></div>';
        }
        
        if($dataToggle == 'date-picker') {
            $output .='<span class="input-group-addon"><i class="glyphicon glyphicon-calendar text-primary"></i></span></div>';
        }
        
            
        if($desc) {
            $output .= "<span class=\"help-block\">". $desc . "</span>";
        }
        if($errors) {
            $output .='<i class="form-control-feedback glyphicon glyphicon-remove"></i>';
            $output .= $errors;
        }
        $output .= "</div>";
        switch ($placement) {
        	case (self::PREPEND):
        	    return $output . $separator . $content;
        	case (self::APPEND):
        	default:
        	    
        	    return $content . $separator . $output;
        }
    }
}