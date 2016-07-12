<?php
declare(strict_types=1);

namespace App\Module\User\Model\Service\PasswordEncoder;

class DefaultPasswordEncoder implements PasswordEncoder
{
    public function encode(string $password) : string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verify(string $rawPassword, string $encodedPassword) : bool
    {
        return password_verify($rawPassword, $encodedPassword);
    }
}
