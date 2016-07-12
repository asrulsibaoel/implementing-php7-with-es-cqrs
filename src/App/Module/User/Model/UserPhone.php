<?php
declare(strict_types=1);

namespace App\Module\User\Model;

class UserPhone
{
    private $countryCode;

    private $phoneNumber;

    private function __construct(string $countryCode, int $phoneNumber)
    {
        $this->countryCode = $countryCode;
        $this->phoneNumber = $phoneNumber;
    }

    public static function fromString(string $phoneNumber) : userPhone
    {
        list($countryCode, $phoneNumber) = explode(' ', $phoneNumber);

        return new static($countryCode, (int) $phoneNumber);
    }

    public function toString() : string
    {
        return $this->countryCode . ' ' . $this->phoneNumber;
    }

    public function sameValueAs(UserPhone $userPhone) : bool
    {
        return $this->toString() === $userPhone->toString();
    }
}
