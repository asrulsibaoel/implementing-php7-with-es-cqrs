<?php

namespace App\Container\Infrastructure;

use Doctrine\DBAL\DriverManager;
use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresContainerId;
use Interop\Config\RequiresMandatoryOptions;
use Interop\Container\ContainerInterface;

final class DoctrineDbalConnectionFactory implements RequiresContainerId, RequiresMandatoryOptions
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container)
    {
        $options = $this->options($container->get('config'));

        return DriverManager::getConnection($options);
    }

    public function vendorName() : string
    {
        return 'doctrine';
    }

    public function packageName() : string
    {
        return 'connection';
    }

    public function containerId() : string
    {
        return 'default';
    }

    public function mandatoryOptions() : array
    {
        return ['driverClass'];
    }
}
