<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\User\Container;

use App\Projection\User\UserFinder;
use App\Projection\User\UserProjector;
use Interop\Container\ContainerInterface;

/**
 * Description of UserProjectorFactory
 *
 * @author asrulsibaoel
 */
final class UserProjectorFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new UserProjector(
                $container->get('doctrine.connection.default'),
                $container->get(UserFinder::class)
        );
    }

}
