<?php
declare(strict_types=1);

namespace App\Module\User\Model;

use ValueObjects\Geography\Address as VOAddress;

class Address
{
    /**
     * @var VOAddress
     */
    private $address;

    /**
     * @param VOAddress $address
     */
    private function __construct(VOAddress $address)
    {
        $this->address = $address;
    }

    public static function fromArray(array $address)
    {
        return new static(VOAddress::fromNative(
            $address['addressee'],
            $address['street'],
            $address['house_number'],
            $address['district'],
            $address['city'],
            $address['region'],
            $address['postal_code'],
            $address['country']
        ));
    }

    public function toArray() : array
    {
        return [
            'addressee' => (string) $this->address->getName(),
            'street' => (string) $this->address->getStreet()->getName(),
            'house_number' => (string) $this->address->getStreet()->getNumber(),
            'district' => (string) $this->address->getDistrict(),
            'city' => (string) $this->address->getCity(),
            'region' => (string) $this->address->getRegion(),
            'postal_code' => (string) $this->address->getPostalCode(),
            'country' => (string) $this->address->getCountry()->getCode()->toNative()
        ];
    }

    public function addressee() : string
    {
        return $this->address->getName();
    }

    public function street() : string
    {
        return $this->address->getStreet()->getName();
    }

    public function houseNumber() : string
    {
        return $this->address->getStreet()->getNumber();
    }

    public function district() : string
    {
        return $this->address->getDistrict();
    }

    public function city() : string
    {
        return $this->address->getCity();
    }

    public function region() : string
    {
        return $this->address->getRegion();
    }

    public function postalCode() : string
    {
        return $this->address->getPostalCode();
    }

    public function country() : string
    {
        return $this->address->getCountry()->getName();
    }
}
