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
 * @category   Controller
 * @package    ErrorController
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: ErrorController.php 1.0  Jaimie Garner $
 */
class ErrorController extends Application_Model_Controller
{

    /**
     * Error Action
     */
    public function errorAction ()
    {
        $errors = $this->_getParam('error_handler');
        
        if (! $errors || ! $errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = '404 The requested page was not found.';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Application error';
                $this->view->exception = $errors->exception;
                break;
        }
        
        $format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
        $formatter = new Zend_Log_Formatter_Simple($format);
        
        $writer = new Zend_Log_Writer_Stream(
                APPLICATION_PATH . '/log/errors.txt');
        
        $writer->setFormatter($formatter);
        
        $logger = new Zend_Log();
        $logger->addWriter($writer);
        $logger->info($errors->exception);
        
        $this->view->request = $errors->request;
    }

    /**
     * Gets Log Writer
     *
     * @return boolean unknown
     */
    public function getLog ()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (! $bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    /**
     * Access Denied
     */
    public function accessDeniedAction ()
    {
    }
}

