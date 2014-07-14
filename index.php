<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','1600M');
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// Define Library Path
defined('LIBRARY_PATH')
|| define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/../library'));

// Define Real Path
defined('REAL_PATH')
|| define('REAL_PATH', realpath(dirname(__FILE__)));

defined('IMAGE_PATH')
|| define('IMAGE_PATH', realpath(dirname(__FILE__) . '/images'));




    /** Zend_Application */
    require_once 'Zend/Application.php';
    
    // Create application, bootstrap, and run
    $application = new Zend_Application(
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );
    $application->bootstrap()
                ->run();
    

    
 
