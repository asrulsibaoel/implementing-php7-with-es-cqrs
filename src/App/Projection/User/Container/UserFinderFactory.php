<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\User\Container;

use App\Projection\User\UserFinder;
use Interop\Container\ContainerInterface;

/**
 * Description of UserFinderFactory
 *
 * @author asrulsibaoel
 */
final class UserFinderFactory
{
    public function __invoke(ContainerInterface $container)
            
    {
        return new UserFinder($container->get('doctrine.connection.default'));
    }
}
