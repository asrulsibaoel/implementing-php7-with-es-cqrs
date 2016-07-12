<?php
declare(strict_types=1);

namespace App\Module\User;

use App\Module\User\Model\Command\RegisterUser;
use App\Module\User\Model\Command\ForgotPassword;
use App\Module\User\Model\User;
use App\Module\User\Model\Service\PasswordEncoder\PasswordEncoder;
use App\Module\User\Container\Model\Service\PasswordHandler\PasswordEncoderFactory;
use App\Module\User\Infrastructure\Repository\EventStoreUserCollection;
use App\Module\User\Model\Handler\RegisterUserHandler;
use App\Module\User\Model\Handler\ForgotPasswordHandler;
use App\Module\User\Container\Model\Handler\RegisterUserHandlerFactory;
use App\Module\User\Container\Model\Handler\ForgotPasswordHandlerFactory;
use App\Module\User\Model\UserCollection;
use App\Module\User\Container\Infrastructure\Repository\EventStoreUserCollectionFactory;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;

class Config
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'invokables' => [

                ],
                'factories' => [
                    PasswordEncoder::class => PasswordEncoderFactory::class,
                    RegisterUserHandler::class => RegisterUserHandlerFactory::class,
                    ForgotPasswordHandler::class => ForgotPasswordHandlerFactory::class,
                    UserCollection::class => EventStoreUserCollectionFactory::class,
                ]
            ],
            'prooph' => [
                'event_store' => [
                    'user_collection' => [
                        'repository_class' => EventStoreUserCollection::class,
                        'aggregate_type' => User::class,
                        'aggregate_translator' => AggregateTranslator::class
                    ],
                ],
                'service_bus' => [
                    'command_bus' => [
                        'router' => [
                            'routes' => [
                                RegisterUser::class => RegisterUserHandler::class,
                                ForgotPassword::class => ForgotPasswordHandler::class
                            ],
                        ],
                    ],
                ],
            ],

        ];
    }
}
