<?php

/**
 * Description of ForgotPasswordHandlerFactory
 *
 * @author asrulsibaoel
 */

namespace App\Module\User\Container\Model\Handler;

use App\Module\User\Model\Handler\ForgotPasswordHandler;
use App\Module\User\Model\Service\PasswordEncoder\PasswordEncoder;
use App\Module\User\Model\UserCollection;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\ServerUrlHelper;


final class ForgotPasswordHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ForgotPasswordHandler([
            $container->get(PasswordEncoder::class),
            $container->get(UserCollection::class),
            $container->get(ServerUrlHelper::class),
        ]);
    }
}
