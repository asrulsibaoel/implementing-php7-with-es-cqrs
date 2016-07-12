<?php
declare(strict_types=1);

namespace App\Module\User\Model\Handler;

use App\Module\User\Model\Command\RegisterUser;
use App\Module\User\Model\UserCollection;
use App\Module\User\Model\Service\PasswordEncoder\PasswordEncoder;
use App\Module\User\Model\User;

final class RegisterUserHandler
{
    private $encoder;

    private $userCollection;

    public function __construct(PasswordEncoder $encoder, UserCollection $userCollection)
    {
        $this->encoder = $encoder;
        $this->userCollection = $userCollection;
    }

    public function __invoke(RegisterUser $command)
    {
        $password = $this->encoder->encode($command->password());

        $user = User::registerWithData($command->userId(), $command->email(), $password);

        $this->userCollection->add($user);
    }
}
