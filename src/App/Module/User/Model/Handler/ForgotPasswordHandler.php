<?php
declare(strict_types=1);

namespace App\Module\User\Model\Handler;

use App\Module\User\Model\Command\ForgotPassword;
use App\Module\User\Model\Service\PasswordEncoder\PasswordEncoder;
use App\Module\User\Model\User;
use App\Module\User\Model\UserCollection;

final class ForgotPasswordHandler
{
    /**
     *
     * @var PasswordEncoder
     */
    private $encoder;

    /**
     *
     * @var UserCollection
     */
    private $userCollection;

    public function __construct(PasswordEncoder $encoder, UserCollection $userCollection)
    {
        $this->encoder = $encoder;
        $this->userCollection = $userCollection;
    }

    public function __invoke(ForgotPassword $command)
    {
        $password = $this->encoder->encode($command->password());

        $user = User::resetPassword($command->userId(), $password);

        $this->userCollection->get($user);
    }
}
