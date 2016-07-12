<?php
declare(strict_types=1);

namespace App\Module\User\Model\Command;

use App\Module\User\Model\EmailAddress;
use App\Module\User\Model\UserId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class RegisterUser extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(
        string $userId,
        string $email,
        string $password
    ) : RegisterUser {
        return new self([
            'user_id' => (string) $userId,
            'email' => (string) $email,
            'password' => (string) $password
        ]);
    }

    public function userId() : UserId
    {
        return UserId::fromString($this->payload['user_id']);
    }

    public function email() : EmailAddress
    {
        return EmailAddress::fromString($this->payload['email']);
    }

    public function password() : string
    {
        return $this->payload['password'];
    }
}
