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
 * @package    Model
 * @copyright  Copyright (c) 2013 Pacific Network Management
 * @license    New BSD License
 * @version    $Id: Crypt.php 1.0  Jaimie Garner $
 */
class Application_Model_Crypt
{

    /**
     *
     * @var string
     */
    protected $_key = 'Apollo!1'; // 8-32 characters without spaces
    
    /**
     * Returns encrypted string
     *
     * @param string $str            
     * @return string
     */
    public function crypt ($str)
    {
        if ($this->_key == '')
            return $str;
        $this->_key = str_replace(chr(32), '', $this->_key);
        if (strlen($this->_key) < 8)
            exit('key error');
        $kl = strlen($this->_key) < 32 ? strlen($this->_key) : 32;
        $k = array();
        for ($i = 0; $i < $kl; $i ++) {
            $k[$i] = ord($this->_key{$i}) & 0x1F;
        }
        $j = 0;
        for ($i = 0; $i < strlen($str); $i ++) {
            $e = ord($str{$i});
            $str{$i} = $e & 0xE0 ? chr($e ^ $k[$j]) : chr($e);
            $j ++;
            $j = $j == $kl ? 0 : $j;
        }
        return $str;
    }

    /**
     * Returns decrypted string
     *
     * @param unknown $str            
     * @return unknown string
     */
    public function decrypt ($str)
    {
        if ($this->_key == '')
            return $str;
        $this->_key = str_replace(chr(32), '', $this->_key);
        if (strlen($this->_key) < 8)
            exit('key error');
        $kl = strlen($this->_key) < 32 ? strlen($this->_key) : 32;
        $k = array();
        for ($i = 0; $i < $kl; $i ++) {
            $k[$i] = ord($this->_key{$i}) & 0x1F;
        }
        $j = 0;
        for ($i = 0; $i < strlen($str); $i ++) {
            $e = ord($str{$i});
            $str{$i} = $e & 0xE0 ? chr($e ^ $k[$j]) : chr($e);
            $j ++;
            $j = $j == $kl ? 0 : $j;
        }
        return $str;
    }
}

