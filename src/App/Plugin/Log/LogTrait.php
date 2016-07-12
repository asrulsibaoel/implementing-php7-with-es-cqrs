<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Plugin;

/**
 * Description of ConfigTrait
 *
 * @author asrulsibaoel
 */
trait ConfigTrait
{
    abstract public function vendorName();
    
    abstract public function loggerName();
    
    abstract public function handlerName();
    
    public function options($config)
    {
        $handler = $this->handlerName();
        $vendor = $this->vendorName();
        
        if(isset($config[$vendor][$handler])){
            $loggerName = $config[$vendor][$handler];
            return $loggerName;
        }
    }
}
