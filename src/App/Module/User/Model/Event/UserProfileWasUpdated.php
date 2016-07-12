<?php
declare(strict_types=1);

namespace App\Module\User\Model\Event;

use App\Module\User\Model\Address;
use App\Module\User\Model\FullName;
use App\Module\User\Model\UserId;
use App\Module\User\Model\UserPhone;
use App\Module\User\Model\UserProfile;
use Prooph\EventSourcing\AggregateChanged;

class UserProfileWasUpdated extends AggregateChanged
{
    private $userId;

    private $profile;

    public static function withProfile(UserId $userId, UserProfile $profile)
    {
        $event = self::occur($userId->toString(), [
            'profile' => $profile->toArray()
        ]);

        $event->userId = $userId;
        $event->profile = $profile;

        return $event;
    }

    public function userId() : UserId
    {
        if (is_null($this->userId)) {
            $this->userId = UserId::fromString($this->aggregateId());
        }

        return $this->userId;
    }

    public function profile() : UserProfile
    {
        if (is_null($this->profile)) {
            $fullName = $this->payload['profile']['full_name'];
            $address = $this->payload['profile']['address'];
            $phone = $this->payload['profile']['phone'];

            $this->profile = UserProfile::withData(
                FullName::fromArray($fullName),
                Address::fromArray($address),
                UserPhone::fromString($phone)
            );
        }

        return $this->profile;
    }
}
