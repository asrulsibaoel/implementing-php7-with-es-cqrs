<?php
declare(strict_types=1);

namespace App\Module\User\Model\Service\PasswordEncoder;

interface PasswordEncoder
{
    public function encode(string $password) : string;

    public function verify(string $rawPassword, string $encodedPassword) : bool;
}
