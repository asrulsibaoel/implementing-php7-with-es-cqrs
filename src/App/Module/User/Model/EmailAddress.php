<?php
declare(strict_types=1);

namespace App\Module\User\Model;

use ValueObjects\Web\EmailAddress as VOEmailAddress;

final class EmailAddress
{
    /**
     * @var VOEmailAddress
     */
    private $email;

    /**
     * @param VOEmailAddress $email
     */
    private function __construct(VOEmailAddress $email)
    {
        $this->email = $email;
    }

    public static function fromString(string $email) : EmailAddress
    {
        return new self(VOEmailAddress::fromNative($email));
    }

    public function toString() : string
    {
        return $this->email->toNative();
    }

    public function name() : string
    {
        return $this->email->getLocalPart();
    }

    public function domain() : string
    {
        return $this->email->getDomainPart()->toNative();
    }

    public function sameValueAs(EmailAddress $email) : bool
    {
        return (bool) ($this->toString() === $email->toString());
    }
}
