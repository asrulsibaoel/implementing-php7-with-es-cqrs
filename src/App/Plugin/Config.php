<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Plugin;

use App\Plugin\Log\Container\LoggerFactory;
use App\Plugin\LogHandler\StreamHandlerFactory;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogHandler;
use Monolog\Logger;

/**
 * Description of Config
 *
 * @author asrulsibaoel
 */
final class Config
{

    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    Logger::class => LoggerFactory::class,
                    StreamHandler::class => StreamHandlerFactory::class,
                    
                ]
            ],
            'logger' => [
                'logger_name' => 'Log',
                'handler' => StreamHandler::class
            ],
            'logger_handler' => [
                StreamHandler::class => [
                    'path' => 'data/log/log - '.date('y-m-d').'.log',
                ],
                RotatingFileHandler::class => [
                ],
                SyslogHandler::class => [
                    
                ],
                ErrorLogHandler::class => [
                    
                ],
            ]
        ];
    }

}
