<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Plugin\Log\Container;

use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Description of LoggerFactory
 *
 * @author asrulsibaoel
 */
final class LoggerFactory
{

    private $container;
    
    public function __invoke(ContainerInterface $container)
    {
        $this->container = $container;
        $config_data = $container->get('config');
        $config = $this->options($config_data);
        $handlerConfig = $this->loggerHandlerConfig($config);
        $handler = new $config($handlerConfig);

        $log = new Logger('Log');
        $log->pushHandler($handler, Logger::WARNING);
        return $log;
    }

    private function loggerHandlerConfig($handlerName)
    {
        $path = '';
        $config = $this->container->get('config');
        if(isset($config[$this->loggerHandler()][$handlerName])){
            $path = (isset($config[$this->loggerHandler()][$handlerName]['path'])) ? $config[$this->loggerHandler()][$handlerName]['path'] : '';
        }
        return $path;
        
    }

    public function options($config)
    {
        $handler = $this->handlerName();
        $vendor = $this->vendorName();

        if (isset($config[$vendor][$handler])) {
            $loggerName = $config[$vendor][$handler];
            return $loggerName;
        }
    }

    public function vendorName()
    {
        return 'logger';
    }

    public function loggerName()
    {
        return 'logger_name';
    }

    private function loggerHandler()
    {
        return 'logger_handler';
    }

    public function handlerName()
    {
        return 'handler';
    }

}
