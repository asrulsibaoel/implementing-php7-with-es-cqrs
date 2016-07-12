<?php


namespace App\Module\User\Model;


class UserProfile
{
    private $fullName;

    private $address;

    private $phone;

    private function __construct(FullName $fullName, Address $address, UserPhone $phone)
    {
        $this->fullName = $fullName;
        $this->address = $address;
        $this->phone = $phone;
    }

    public static function withData(FullName $fullName, Address $address, UserPhone $phone)
    {
        return new static($fullName, $address, $phone);
    }

    public function fullName() : FullName
    {
        return $this->fullName;
    }

    public function address() : Address
    {
        return $this->address;
    }

    public function phone() : UserPhone
    {
        return $this->phone;
    }

    public function toArray() : array
    {
        return [
            'fullname' => $this->fullName->toArray(),
            'address' => $this->address->toArray(),
            'phone' => $this->phone->toString()
        ];
    }

    public function sameValueAs(UserProfile $userProfile) : bool
    {
        return $this->toArray() === $userProfile->toArray();
    }
}
