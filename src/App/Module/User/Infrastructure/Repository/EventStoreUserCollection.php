<?php
declare(strict_types=1);

namespace App\Module\User\Infrastructure\Repository;

use App\Module\User\Model\User;
use App\Module\User\Model\UserCollection;
use App\Module\User\Model\UserId;
use Prooph\EventStore\Aggregate\AggregateRepository;

class EventStoreUserCollection extends AggregateRepository implements UserCollection
{
    public function add(User $user)
    {
        $this->addAggregateRoot($user);
    }

    public function get(UserId $userId) : User
    {
        return $this->getAggregateRoot($userId->toString());
    }
}
