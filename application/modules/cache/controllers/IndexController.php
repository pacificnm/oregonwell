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
 * @category   Cache
 * @package    Controller
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: IndexController.php 1.0  Jaimie Garner $
 */
class Cache_IndexController extends Application_Model_Controller
{

    /**
     * (non-PHPdoc)
     *
     * @see Application_Model_Base::init()
     */
    public function init ()
    {
        parent::init();
    }

    /**
     * Index Action
     */
    public function indexAction ()
    {
        $handle = opendir(APPLICATION_PATH . '/cache');
        
        $this->view->handle = $handle;
    }
    
    public function cleanAction()
    {
        $dir = $this->getParam('directory');
        
        $this->recursiveRemove(APPLICATION_PATH . '/cache/' . $dir);
        
        $this->view->directory = $dir;
    }
    
    public function rebuildAction()
    {
        
    }
    
    private function recursiveRemove($dir) {
        $structure = glob(rtrim($dir, "/").'/*');
        if (is_array($structure)) {
            foreach($structure as $file) {
                if (is_dir($file)) $this->recursiveRemove($file);
                elseif (is_file($file)) unlink($file);
            }
        }
        rmdir($dir);
    }
}