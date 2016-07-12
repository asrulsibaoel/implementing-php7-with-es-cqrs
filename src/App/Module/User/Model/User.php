<?php
declare(strict_types=1);

namespace App\Module\User\Model;

use App\Module\User\Model\Event\UserProfileWasUpdated;
use App\Module\User\Model\Event\UserWasRegistered;
use App\Module\User\Model\Event\PasswordChanged;
use Prooph\EventSourcing\AggregateRoot;

final class User extends AggregateRoot
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var EmailAddress
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var UserProfile|array
     */
    private $profile;

    public static function registerWithData(UserId $userId, EmailAddress $email, string $password) : User
    {
        $self = new self();

        $self->recordThat(UserWasRegistered::withData($userId, $email, $password));

        return $self;
    }
    
    public static function resetPassword(string $userId, string $password) : User
    {
        $self = new self();

        $self->recordThat(PasswordChanged::withData($userId, $password));

        return $self;
    }
    
    public function whenPasswordChanged(PasswordChanged $event)
    {
        $this->password = $event->password();
    }

    public function updateProfile(FullName $fullName, Address $address, UserPhone $phone)
    {
        $this->recordThat(UserProfileWasUpdated::withProfile($this->userId, UserProfile::withData(
            $fullName,
            $address,
            $phone
        )));
    }

    public function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->userId = $event->userId();
        $this->email = $event->email();
        $this->password = $event->password();
        $this->profile = [];
    }

    public function whenUserProfileWasUpdated(UserProfileWasUpdated $event)
    {
        $this->profile = $event->profile();
    }

    protected function aggregateId() : string
    {
        return $this->userId->toString();
    }

    public function userId() : UserId
    {
        return $this->userId;
    }

    public function email() : EmailAddress
    {
        return $this->email;
    }

    public function password() : string
    {
        return $this->password;
    }

    public function profile() : UserProfile
    {
        return $this->profile;
    }
}
