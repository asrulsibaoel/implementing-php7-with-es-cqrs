<?php
declare(strict_types=1);

namespace App\Module\User\Container\Model\Service\PasswordHandler;

use App\Module\User\Model\Service\PasswordEncoder\DefaultPasswordEncoder;
use Interop\Container\ContainerInterface;

final class PasswordEncoderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new DefaultPasswordEncoder();
    }
}
