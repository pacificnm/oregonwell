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
 * @category   Auth
 * @package    Form
 * @subpackage Element
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Email.php 1.0  Jaimie Garner $
 */
class Auth_Form_Element_Email extends Zend_Form_Element_Text
{
    /**
     * (non-PHPdoc)
     * @see Zend_Form_Element::init()
     */
    public function init()
    {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH .'/forms', 'decorator');
         
        $this->setLabel('Email Address')
            ->setRequired('true')
            ->setDecorators(array('Decorator'))
            ->setAttrib('class', 'form-control')
            ->setAttrib('data-size', 'col-lg-5')
            ->setAttrib('autocomplete', 'off');


        $validators = array(
                array(
                        'validator'=>'NotEmpty',
                        'options'=>array(
                                'messages'=> 'Email field is required!'
                        ),
                        'breakChainOnFailure'=>false
                ),
                array(
                        'validator'=>'EmailAddress',
                        'options'=>array(
                                'messages'=> '%value% is not a valid E-Mail Address!'
                        ),
                        'breakChainOnFailure'=>false
                ),
                array(
                        'validator'=>'Db_NoRecordExists',
                        'options'=>array(
                                'table' => 'auth',
                                'field' => 'email',
                                'messages'=> '%value% has already been used!'
                        ),
                        'breakChainOnFailure'=>false
                ),
        );


        $this->addValidators($validators);


    }
}
