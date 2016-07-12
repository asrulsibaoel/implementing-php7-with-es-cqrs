<?php

namespace AppTest\Module\Model;

use App\Module\User\Model\Address;
use App\Module\User\Model\EmailAddress;
use App\Module\User\Model\Event\UserProfileWasUpdated;
use App\Module\User\Model\Event\UserWasRegistered;
use App\Module\User\Model\FullName;
use App\Module\User\Model\User;
use App\Module\User\Model\UserId;
use App\Module\User\Model\UserPhone;
use App\Module\User\Model\UserProfile;
use App\Module\User\Model\Event\PasswordChanged;
use AppTest\Base;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserTest extends Base
{

    /**
     * @test
     */
    public function it_can_register_user()
    {
        $userId = UserId::generate();
        $password = 'somepassword';
        $email = EmailAddress::fromString('jowy@oiry.net');

        $user = User::registerWithData($userId, $email, $password);

        $events = $this->popRecordedEvent($user);

        $this->assertEquals(1, count($events));

        $this->assertInstanceOf(UserWasRegistered::class, $events[0]);

        $this->assertEquals($events[0]->password(), $password);
        $this->assertTrue($email->sameValueAs($events[0]->email()));
    }

    /**
     * @test
     */
    public function it_can_update_user_profile()
    {
        $userId = UserId::generate();
        $password = 'somepassword';
        $email = EmailAddress::fromString('jowy@oiry.net');

        $user = User::registerWithData($userId, $email, $password);

        $fullName = [
            'first_name' => 'Prasetyo',
            'middle_name' => '',
            'last_name' => 'Wicaksono'
        ];

        $address = [
            'addressee' => 'Prasetyo Wicaksono',
            'street' => 'Jalan Jombang',
            'house_number' => '16',
            'district' => 'Klojen',
            'city' => 'Malang',
            'region' => 'Jawa Timur',
            'postal_code' => '65115',
            'country' => 'ID'
        ];

        $phone = '+62 8963238273';

        $user->updateProfile(
                FullName::fromArray($fullName), Address::fromArray($address), UserPhone::fromString($phone)
        );

        $events = $this->popRecordedEvent($user);

        $this->assertEquals(2, count($events));

        $this->assertInstanceOf(UserWasRegistered::class, $events[0]);
        $this->assertInstanceOf(UserProfileWasUpdated::class, $events[1]);
    }
}
