<?php
declare(strict_types=1);

namespace App\Module\User\Model;

use ValueObjects\Person\Name;

class FullName
{
    private $fullName;

    private function __construct(Name $fullName)
    {
        $this->fullName = $fullName;
    }

    public static function fromArray(array $fullName)
    {
        return new static(Name::fromNative(
            $fullName['first_name'],
            $fullName['middle_name'],
            $fullName['last_name']
        ));
    }

    public function toArray() : array
    {
        return [
            'first_name' => (string) $this->fullName->getFirstName(),
            'middle_name' => (string) $this->fullName->getMiddleName(),
            'last_name' => (string) $this->fullName->getLastName()
        ];
    }

    public function firstName() : string
    {
        return $this->fullName->getFirstName();
    }

    public function middleName() : string
    {
        return $this->fullName->getMiddleName();
    }

    public function lastName() : string
    {
        return $this->fullName->getLastName();
    }

    public function fullName() : string
    {
        return $this->fullName->getFullName();
    }

    public function sameValueAs(FullName $fullName) : bool
    {
        return $this->fullName() === $fullName->fullName();
    }
}
