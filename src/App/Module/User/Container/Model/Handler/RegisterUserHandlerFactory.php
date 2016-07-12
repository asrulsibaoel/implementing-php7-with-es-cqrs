<?php
declare(strict_types=1);

namespace App\Module\User\Container\Model\Handler;

use App\Module\User\Model\Handler\RegisterUserHandler;
use App\Module\User\Model\Service\PasswordEncoder\PasswordEncoder;
use App\Module\User\Model\UserCollection;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\ServerUrlHelper;

final class RegisterUserHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new RegisterUserHandler(
            $container->get(PasswordEncoder::class),
            $container->get(UserCollection::class),
            $container->get(ServerUrlHelper::class)
        );
    }
}
