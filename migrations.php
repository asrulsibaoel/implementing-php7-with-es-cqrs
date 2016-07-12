#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/config/container.php';

$cli = new \Symfony\Component\Console\Application(
    'Doctrine Command Line Interface',
    \Doctrine\DBAL\Migrations\MigrationsVersion::VERSION()
);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet();
$helperSet->set(new \Symfony\Component\Console\Helper\DialogHelper(), 'dialog');
$helperSet->set(
    new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper(
        $container->get('doctrine.connection.default')
    ),
    'connection'
);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->addCommands(array(
    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));

$cli->run();
