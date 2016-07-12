<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Plugin\LogHandler;

use App\Plugin\LogHandler\LogHandlerTrait;
use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;

/**
 * Description of StreamHandlerFactory
 *
 * @author asrulsibaoel
 */
final class StreamHandlerFactory
{
    use LogHandlerTrait;
    
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = $this->options($config);
        
        return new StreamHandler($config['path']);
    }

    public function loggerName()
    {
        return 'path';
    }

    public function vendorName()
    {
        return 'logger_handler';
    }

}
