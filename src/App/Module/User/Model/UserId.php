<?php
declare(strict_types=1);

namespace App\Module\User\Model;

use Rhumsaa\Uuid\Uuid;

final class UserId
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function generate() : UserId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $uuid) : UserId
    {
        return new self(Uuid::fromString($uuid));
    }

    public function toString() : string
    {
        return $this->uuid->toString();
    }

    public function sameValueAs(UserId $userId) : bool
    {
        return $this->uuid->toString() === $userId->toString();
    }
}
