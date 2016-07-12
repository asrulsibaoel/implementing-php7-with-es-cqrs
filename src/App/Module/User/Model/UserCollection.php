<?php
declare(strict_types=1);

namespace App\Module\User\Model;

interface UserCollection
{
    public function add(User $user);

    public function get(UserId $userId) : User;
}
