<?php
declare(strict_types=1);

namespace App\Module\User\Model\Event;

use App\Module\User\Model\EmailAddress;
use App\Module\User\Model\UserId;
use Prooph\EventSourcing\AggregateChanged;

final class UserWasRegistered extends AggregateChanged
{
    private $userId;

    private $email;

    private $password;

    public static function withData(UserId $userId, EmailAddress $email, $password) : UserWasRegistered
    {
        $event = self::occur($userId->toString(), [
            'email' => $email->toString(),
            'password' => $password
        ]);

        $event->userId = $userId;
        $event->email = $email;
        $event->password = $password;

        return $event;
    }

    public function userId() : UserId
    {
        if (is_null($this->userId)) {
            $this->userId = UserId::fromString($this->aggregateId());
        }

        return $this->userId;
    }

    public function email()
    {
        if (is_null($this->email)) {
            $this->email = EmailAddress::fromString($this->payload['email']);
        }

        return $this->email;
    }

    public function password()
    {
        if (is_null($this->password)) {
            $this->password = $this->payload['password'];
        }

        return $this->password;
    }
}
