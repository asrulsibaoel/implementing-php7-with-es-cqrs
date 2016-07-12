<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Plugin\LogHandler;

/**
 * Description of ConfigTrait
 *
 * @author asrulsibaoel
 */
trait LogHandlerTrait
{
    abstract public function vendorName();
    
    abstract public function loggerName();
    
    public function options($config)
    {
        $logger = $this->loggerName();
        $vendor = $this->vendorName();
        
        if(isset($config[$vendor][$logger])){
            $loggerName = $config[$vendor][$logger][self::class];
            return $loggerName;
        }
    }
}
