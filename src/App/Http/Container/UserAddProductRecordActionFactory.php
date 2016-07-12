<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Container;

use App\Http\Action\UserAddProductRecordAction;
use Interop\Container\ContainerInterface;
use Prooph\Common\Messaging\FQCNMessageFactory;
use Prooph\ServiceBus\CommandBus;
use Zend\Expressive\Helper\ServerUrlHelper;

/**
 * Description of UserAddProductRecordActionFactory
 *
 * @author asrulsibaoel
 */
final class UserAddProductRecordActionFactory
{

    /**
     * 
     * @param ContainerInterface $container
     * @return UserAddProductRecordAction
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserAddProductRecordAction(
                $container->get(CommandBus::class), 
                $container->get(FQCNMessageFactory::class), 
                $container->get(ServerUrlHelper::class)
        );
    }

}
